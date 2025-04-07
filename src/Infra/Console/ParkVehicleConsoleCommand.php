<?php

declare(strict_types=1);

namespace Fulll\Infra\Console;

use Fulll\App\Services\ParkVehicleService;
use Fulll\Domain\Models\Vehicle;
use Fulll\Infra\Repositories\SqLiteVehicleRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'fulll:localize-vehicle',
    description: 'Park a vehicle',
)]
final class ParkVehicleConsoleCommand extends Command
{
    public function __construct(
        private readonly ParkVehicleService $parkVehicleService,
        private SqLiteVehicleRepository $sqLiteVehicleRepository,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Park a vehicle')
            ->addArgument('fleetId', InputArgument::REQUIRED, 'Fleet ID')
            ->addArgument('vehiclePlateNumber', InputArgument::REQUIRED, 'Vehicle Plate Number')
            ->addArgument('lat lng', InputArgument::REQUIRED, 'GPS coordinates')
            ->addArgument('alt', InputArgument::OPTIONAL, 'ALtitude');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fleetId = (int) $input->getArgument('fleetId');
        $vehiclePlateNumber = (string) $input->getArgument('vehiclePlateNumber');
        $lat_lng = (string) $input->getArgument('lat lng');
        $alt = (string) $input->getArgument('alt') ?? null;
        $vehicle_id = $this->sqLiteVehiculeRepository->findIdByPlateNumber(plateNumber : $vehiclePlateNumber);
        if (null === $vehicle_id) {
            throw new \Exception('THe vehicle does not exist');
        }
        $vehicle = new Vehicle(id : $vehicle_id, plate_number : $vehiclePlateNumber);

        try {
            $this->parkVehicleService->parkVehicle(vehicle : $vehicle, fleet_id : $fleetId, gps_coordinates : $lat_lng, alt : $alt);
            $output->writeln('<info>✅ Vehicle successfully parked.</info>');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('<comment>⚠️  '.$e->getMessage().'</comment>');

            return Command::FAILURE;
        } catch (\Throwable $e) {
            $output->writeln('<error>❌ An unexpected error occurred: '.$e->getMessage().'</error>');

            return Command::FAILURE;
        }
    }
}

<?php

declare(strict_types=1);

namespace Fulll\Infra\Console;

use Fulll\Domain\Models\Vehicle;
use Fulll\App\Services\ParkVehicleService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Fulll\Domain\Exceptions\VehicleAlreadyRegisteredException;

#[AsCommand(
    name: 'fulll:localize-vehicle',
    description: 'Park a vehicle',
)]
final class ParkVehicleConsoleCommand extends Command
{
    public function __construct(
        private readonly ParkVehicleService $ParkVehicleService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Park a vehicule')
            ->addArgument('fleetId', InputArgument::REQUIRED, 'Fleet ID')
            ->addArgument('vehiclePlateNumber', InputArgument::REQUIRED, 'Vehicle Plate Number');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fleetId = (int) $input->getArgument('fleetId');
        $vehiclePlateNumber = (int) $input->getArgument('vehiclePlateNumber');
        $vehicle = new Vehicle($vehiclePlateNumber);

        try {
            $this->registerVehicleService->registerVehicle($vehicle, $fleetId);
            $output->writeln('<info>✅ Vehicle successfully registered to the fleet.</info>');
            return Command::SUCCESS;
        } catch (VehicleAlreadyRegisteredException $e) {
            $output->writeln('<comment>⚠️  ' . $e->getMessage() . '</comment>');
            return Command::FAILURE;
        } catch (\Throwable $e) {
            $output->writeln('<error>❌ An unexpected error occurred: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }
    }
}

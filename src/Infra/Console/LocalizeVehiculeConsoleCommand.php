<?php

declare(strict_types=1);

namespace Fulll\Infra\Console;

use Fulll\App\Services\RegisterVehicleService;
use Fulll\Domain\Exceptions\VehicleAlreadyRegisteredException;
use Fulll\Domain\Models\Vehicle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'fulll:localize-vehicle',
    description: 'Park a vehicle',
)]
final class LocalizeVehicleConsoleCommand extends Command
{
    public function __construct(
        private readonly RegisterVehicleService $registerVehicleService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Registers a vehicle into a fleet')
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

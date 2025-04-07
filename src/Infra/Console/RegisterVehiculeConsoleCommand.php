<?php

declare(strict_types=1);

namespace Fulll\Infra\Console;

use Fulll\App\Services\RegisterVehiculeService;
use Fulll\Domain\Exceptions\VehiculeAlreadyRegisteredException;
use Fulll\Domain\Models\Vehicule;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'fulll:register-vehicule',
    description: 'Registers a vehicule to a fleet',
)]
final class RegisterVehiculeConsoleCommand extends Command
{
    public function __construct(
        private readonly RegisterVehiculeService $registerVehiculeService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Registers a vehicule into a fleet')
            ->addArgument('fleetId', InputArgument::REQUIRED, 'Fleet ID')
            ->addArgument('vehiculePlateNumber', InputArgument::REQUIRED, 'Vehicule Plate Number');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fleetId = (int) $input->getArgument('fleetId');
        $vehiculePlateNumber = (int) $input->getArgument('vehiculePlateNumber');
        $vehicule = new Vehicule($vehiculePlateNumber);

        try {
            $this->registerVehiculeService->registerVehicule($vehicule, $fleetId);
            $output->writeln('<info>✅ Vehicule successfully registered to the fleet.</info>');
            return Command::SUCCESS;
        } catch (VehiculeAlreadyRegisteredException $e) {
            $output->writeln('<comment>⚠️  ' . $e->getMessage() . '</comment>');
            return Command::FAILURE;
        } catch (\Throwable $e) {
            $output->writeln('<error>❌ An unexpected error occurred: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }
    }
}

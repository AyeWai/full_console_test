<?php

declare(strict_types=1);

namespace Fulll\Infra\Console;

use Fulll\App\Services\RegisterVehiculeService;
use Fulll\Domain\Exception\VehiculeAlreadyRegisteredException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'fulll:register-vehicule',
    description: 'Registers a vehicule to a fleet',
)]
class RegisterVehiculeConsoleCommand extends Command
{
    public function __construct(
        private readonly RegisterVehiculeService $registerVehiculeService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Registers a vehicule into a fleet')
            ->addArgument('fleetId', InputArgument::REQUIRED, 'Fleet ID')
            ->addArgument('vehiculeId', InputArgument::REQUIRED, 'Vehicule ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fleetId = (int) $input->getArgument('fleetId');
        $vehiculeId = (int) $input->getArgument('vehiculeId');

        try {
            $this->registerVehiculeService->register($fleetId, $vehiculeId);
            $output->writeln('<info>✅ Vehicule successfully registered to the fleet.</info>');
            return Command::SUCCESS;
        } catch (VehiculeAlreadyRegisteredException $e) {
            $output->writeln('<comment>⚠️  ' . $e->getMessage() . '</comment>');
            return Command::FAILURE;
        } catch (VehiculeNotFoundException $e) {
            $output->writeln('<error>❌  ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        } catch (\Throwable $e) {
            $output->writeln('<error>❌ An unexpected error occurred: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }
    }
}

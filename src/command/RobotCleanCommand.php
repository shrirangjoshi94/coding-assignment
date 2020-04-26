<?php

declare(strict_types=1);

namespace App\Src\Command;

use App\Classes\Robot;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{InputInterface, InputOption};
use Symfony\Component\Console\Output\OutputInterface;

class RobotCleanCommand extends Command
{
    /**
     * Command configuration.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('clean')
            ->addOption('floor', NULL, InputOption::VALUE_REQUIRED)
            ->addOption('area', NULL, InputOption::VALUE_REQUIRED);
    }

    /**
     * Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->process($input, $output);

        return 0;
    }

    /**
     * Process the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    private function process(InputInterface $input, OutputInterface $output): void
    {
        $output->writeln('=====+=====+=====+=====+=====+=====+=====+=====+=====');
        $floor = $input->getOption('floor');
        $area = (float)$input->getOption('area');
        $isFloorValid = $this->isFloorTypeValid($floor);
        $isAreaValid = $this->isFloorAreaValid($area);
        $output->writeln(sprintf('floor: %s %s', $floor, ($isFloorValid ? '' : ' - not valid')));
        $output->writeln(sprintf('area: %s %s', $area, ($isAreaValid ? '' : ' - not valid')));
        $output->writeln('=====+=====+=====+=====+=====+=====+=====+=====+=====');

        if ($isFloorValid && $isAreaValid) {
            $this->displayOutput($floor, $area);
        }
    }

    /**
     * Make the robot work and display the output.
     *
     * @param string $floor
     * @param float $area
     *
     * @return void
     */
    private function displayOutput(string $floor, float $area): void
    {
        $robot = new Robot($floor, $area);
        $robot->work();
    }

    /**
     * Check floor type is valid.
     *
     * @param string $floorType
     *
     * @return bool
     */
    private function isFloorTypeValid(string $floorType): bool
    {
        return array_key_exists($floorType, Robot::FLOOR_TYPES);
    }

    /**
     * Check floor area is valid.
     *
     * @param float $area
     *
     * @return bool
     */
    private function isFloorAreaValid(float $area): bool
    {
        return is_numeric($area) && ($area > 0);
    }
}
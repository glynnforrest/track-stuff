<?php

namespace TrackStuff\Command;

use Neptune\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TrackCommand extends Command
{
    protected $name = 'track-stuff:track';
    protected $description = 'Track stuff from the console.';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelper('dialog');
        $updater = $this->neptune['track-stuff.goal_updater'];

        $output->writeln(sprintf('<info>Track stuff!</info>'));
        $output->writeln('Press return to finish.');

        $date = new \DateTime();
        while (true) {
            $text = $dialog->ask($output, '> ');
            if (strlen($text) === 0) {
                break;
            }
            $logs = $updater->createLogsFromText($text, $date);

            foreach ($logs as $log) {
                $output->writeln(sprintf('Tracked: %s %s on %s', $log->amount, $log->goal->slug, $date->format('Y-m-d')));
            }
        }
    }
}

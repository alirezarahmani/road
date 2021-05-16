<?php

namespace App\Command;

use App\Domain\Rent;
use App\Domain\RentStationEquipment;
use App\Domain\Station;
use App\Domain\StationEquipments;
use App\Domain\Van;
use App\Repositories\RentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:test';

    public function __construct(public RentRepository $repository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $em = $this->repository->em();
        $van = $em->getRepository(Van::class);
        $van = $van->find(1);
        $st = $em->getRepository(Station::class);
        $st1 = $st->find(1);
        $st2 = $st->find(2);

        // ... put here the code to create the user
        $rent = new Rent();
        $rent->setStartAt(new \DateTime('2020-05-01'));
        $rent->setEndAt(new \DateTime('2020-08-01'));
        $rent->setEndStation($st2);
        $rent->setStartStation($st1);
        $rent->setVan($van);
        $this->repository->creat($rent);

        $sta =  new RentStationEquipment();
        $sta->

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}

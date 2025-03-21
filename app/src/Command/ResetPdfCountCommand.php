<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:reset-pdf-count',
    description: 'Réinitialise le compteur de PDF pour tous les utilisateurs à 00h00.',
)]
class ResetPdfCountCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        foreach ($users as $user) {
            $user->setPdfCount(0);
        }

        $this->entityManager->flush();

        $output->writeln('Le compteur de PDF a été réinitialisé pour tous les utilisateurs.');

        return Command::SUCCESS;
    }
}

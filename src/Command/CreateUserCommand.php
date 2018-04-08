<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 11:06
 */

namespace App\Command;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    private $entityManager;
    private $passwordEncoder;

    protected function configure()
    {
        $this->setName('app:create-user')
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user.')
            ->addArgument('username', InputArgument::REQUIRED, 'the username of the user.')
            ->addArgument('email', InputArgument::REQUIRED, 'the email of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'the password of the user')
            ->addArgument('roles', InputArgument::REQUIRED, 'the role of the user');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);


        $output->writeln('GREAT!!!!');

        $output->write('You are about to ');
        $output->write('create a user.');

        $output->writeln('With Username: '.$input->getArgument('username'));
        $output->writeln('With Email: '.$input->getArgument('email'));
        $output->writeln('With Password: '.$input->getArgument('password'));
        $output->writeln('With the security Role: '.$input->getArgument('roles'));

        $user = new User();
        $user->setUsername($input->getArgument('username'));
        $password = $this->passwordEncoder->encodePassword($user, $input->getArgument('password'));
        $user->setPassword($password);

        $user->setEmail($input->getArgument('email'));
        $user->setRoles($input->getArgument('roles'));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }
}
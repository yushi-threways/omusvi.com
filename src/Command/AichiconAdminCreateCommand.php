<?php
namespace App\Command;
use App\Security\Manager\AdminManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
class AichiconAdminCreateCommand extends Command
{
    protected static $defaultName = 'aichicon:admin:create';
    private $manager;
    
    public function __construct(AdminManager $manager, ?string $name = null)
    {
        parent::__construct($name);
        $this->manager = $manager;
    }
    
    protected function configure()
    {
        $this
            ->setDescription('Create a Admin.')
            ->setDefinition(array(
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputOption('inactive', null, InputOption::VALUE_NONE, 'Set the admin as inactive'),
            ))
        ;
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $inactive = $input->getOption('inactive');
        if (!preg_match('/^[a-zA-Z0-9\!-\~]{4,}$/', $username)) {
            throw new \Exception('4文字以上の英数字で入力してください');
        }
        if (!preg_match('/^[a-zA-Z0-9\!-\~]{4,}$/', $password)) {
            throw new \Exception('4文字以上の英数字で入力してください');
        }
        if (empty($email)) {
            throw new \Exception('Email can not be empty');
        }
        $user = $this->manager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled(!$inactive);
        $user->setSuperAdmin(true);
        $user->addRole('ROLE_ADMIN');
        $this->manager->updateUser($user);
        
        $output->writeln(sprintf('Created Admin <comment>%s</comment>', $username));
    }
    
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        
        if (!$input->getArgument('username')) {
            $question = new Question("Please choose a username: ", null);
            $question->setValidator(  function($username) {
                if (!preg_match('/^[a-zA-Z0-9\!-\~]{4,}$/', $username)) {
                    throw new \Exception('4文字以上の英数字で入力してください');
                }
                return $username;
            });
            
            $inputted = $helper->ask($input, $output, $question);
            $input->setArgument('username', $inputted);
        }
    
        if (!$input->getArgument('password')) {
            $question = new Question("Please choose a password: ", null);
            $question->setHidden(true);
            $question->setValidator(  function($password) {
                if (!preg_match('/^[a-zA-Z0-9\!-\~]{4,}$/', $password)) {
                    throw new \Exception('4文字以上の英数字で入力してください');
                }
                return $password;
            });
            
            $inputted = $helper->ask($input, $output, $question);
            $input->setArgument('password', $inputted);
        }
    
        if (!$input->getArgument('email')) {
            $question = new Question("Please choose a email: ", null);
            $question->setValidator(function ($email) {
                if (empty($email)) {
                    throw new \Exception('Email can not be empty');
                }
                return $email;
            });
            
            $inputted = $helper->ask($input, $output, $question);
            $input->setArgument('email', $inputted);
        }
    }
}
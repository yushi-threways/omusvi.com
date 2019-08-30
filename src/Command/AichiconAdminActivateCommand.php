<?php
namespace App\Command;

use App\Security\Manager\AdminManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AichiconAdminActivateCommand extends Command
{
    protected static $defaultName = 'aichicon:admin:activate';
    /**
     * @var AdminManager
     */
    private $manager;
    public function __construct(AdminManager $manager, ?string $name = null)
    {
        parent::__construct($name);
        $this->manager = $manager;
    }
    protected function configure()
    {
        $this
            ->setDescription('Activate an admin')
            ->setDefinition(array(
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
            ))
        ;
    }
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        if (empty($username)) {
            throw new \InvalidArgumentException('Username can not be empty.');
        }
        $user = $this->manager->findUserByUsername($username);
        if (!$user) {
            throw new \RuntimeException(sprintf('User identified by "%s" username does not exist.', $username));
        }
        if ($user->isEnabled()) {
            throw new \RuntimeException(sprintf('Admin "%s" has already been activated.', $username));
        }
        $user->setEnabled(true);
        $this->manager->updateUser($user);
        $output->writeln(sprintf('Admin <comment>%s</comment> has been activated.', $username));
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
            $question = new Question("Please give the username: ", null);
            $question->setValidator(function($username) {
                if (empty($username)) {
                    throw new \InvalidArgumentException('Username can not be empty.');
                }
                $user = $this->manager->findUserByUsername($username);
                //usernameが存在しているか
                if (!$user) {
                    throw new \RuntimeException(sprintf('AdminUser identified by "%s" username does not exist.', $username));
                }
                //すでにenabled
                if ($user->isEnabled()) {
                    throw new \RuntimeException(sprintf('Admin "%s" has already been activated.', $username));
                }
                return $username;
            });
            $inputted = $helper->ask($input, $output, $question);
            $input->setArgument('username', $inputted);
        }
    }
}
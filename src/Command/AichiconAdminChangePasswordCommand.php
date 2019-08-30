<?php
namespace App\Command;
use App\Security\Manager\AdminManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
class AichiconAdminChangePasswordCommand extends Command
{
    protected static $defaultName = 'aichicon:admin:change-password';
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
            ->setDescription('Change the password of an Admin')
            ->setDefinition(array(
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
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
            throw new \Exception('Username can not be empty.');
        }
        $password = $input->getArgument('password');
        if (empty($password)) {
            throw new \Exception('Password can not be empty.');
        }
        if (!preg_match('/^[a-zA-Z0-9\!-\~]{4,}$/', $password)) {
            throw new \Exception('4文字以上の英数字で入力してください');
        }
        $user = $this->manager->findUserByUsername($username);
        if (!$user) {
            throw new \RuntimeException(sprintf('AdminUser identified by "%s" username does not exist.', $username));
        }
        $user->setPlainPassword($password);
        $this->manager->updateUser($user);
        $output->writeln(sprintf('Changed password for user <comment>%s</comment>', $username));
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
                    throw new \Exception('Username can not be empty.');
                }
                $user = $this->manager->findUserByUsername($username);
                //usernameが存在しているか
                if (!$user) {
                    throw new \RuntimeException(sprintf('AdminUser identified by "%s" username does not exist.', $username));
                }
                return $username;
            });
            $inputted = $helper->ask($input, $output, $question);
            $input->setArgument('username', $inputted);
        }
        if (!$input->getArgument('password')) {
            $question = new Question("Please enter the new password:", null);
            $question->setHidden(true);
            $question->setValidator(function($password) {
                if (!preg_match('/^[a-zA-Z0-9\!-\~]{4,}$/', $password)) {
                    throw new \Exception('4文字以上の英数字で入力してください');
                }
                return $password;
            });
            $inputted = $helper->ask($input, $output, $question);
            $input->setArgument('password', $inputted);
        }
    }
}
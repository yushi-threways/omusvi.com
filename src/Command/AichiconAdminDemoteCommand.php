<?php
namespace App\Command;
use App\Security\Manager\AdminManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
class AichiconAdminDemoteCommand extends Command
{
    protected static $defaultName = 'aichicon:admin:demote';
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
            ->setDescription('Demote an admin by removing a role')
            ->setDefinition(array(
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('role', InputArgument::OPTIONAL, 'The role'),
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
        $role = $input->getArgument('role');
        if (empty($role)) {
            throw new \Exception('Role can not be empty');
        }
        $user = $this->manager->findUserByUsername($username);
        if (!$user) {
            throw new \RuntimeException(sprintf('AdminUser identified by "%s" username does not exist.', $username));
        }
        if (!$user->hasRole($role)) {
            throw new \Exception(sprintf('Admin "%s" didn\'t have "%s" role.', $username, $role));
        }
        $user->removeRole($role);
        $this->manager->updateUser($user);
        $output->writeln(sprintf('Role <comment>%s</comment> has been removed from admin <comment>%s</comment>. This change will not apply until the user logs out and back in again.', $role, $username));
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
        $username = $input->getArgument('username');
        $user = $this->manager->findUserByUsername($username);
        $dstRoles = [];
        if ($user) {
            $dstRoles = $user->getRoles();
        }
        $dstRolesStrings = implode(", ", $dstRoles);
        if (!$input->getArgument('role')) {
            $question = new Question("Please choose a role [{$dstRolesStrings}] :");
            $question->setValidator(function($role) use($username, $user, $dstRoles) {
                if (empty($role)) {
                    throw new \Exception('Role can not be empty');
                }
                //指定したroleを持っていない
                if (!$user->hasRole($role)) {
                    throw new \Exception(sprintf('Admin "%s" didn\'t have "%s" role.', $username, $role));
                }
                return $role;
            });
            $inputted = $helper->ask($input, $output, $question);
            $input->setArgument('role', $inputted);
        }
    }
}
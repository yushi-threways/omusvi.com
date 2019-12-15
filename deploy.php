<?php
namespace Deployer;

require 'recipe/symfony4.php';

// Project name
set('application', 'omusvi.com');

// Project repository
set('repository', 'git@github.com:yushi-threways/omusvi.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

set('http_user', 'yljcocpi');

set('writable_mode', 'chmod');

// Hosts
host('sekimixhost')
    ->user('yljcocpi')
    ->port(22)
    ->stage('staging')
    ->set('branch', 'master')
    ->set('deploy_path', '~/public_html/test/{{application}}') // Define the base path to deploy your project to.
    ->set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader')
    ->add('shared_files', ['.env.local', 'public/.htaccess']);

host('omusvi.com')
    ->user('lbqhvbsc')
    ->port(22)
    ->stage('prod')
    ->set('branch', 'master')
    ->set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader')
    ->set('deploy_path', '~/public_html/{{application}}')
    ->add('shared_files', ['.env.local', 'public/.htaccess']);

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

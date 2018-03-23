<?php
namespace Deployer;

require 'recipe/symfony.php';


// Project name
set('application', 'my_project');

// Project repository
set('ssh_type', 'native');
set('ssh_multiplexing', false);
set('repository', 'git@github.com:shynixxx/my-project.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts
host('dev2.ylly.fr')
    ->user('ylly')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/p/circle_ci_test');

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

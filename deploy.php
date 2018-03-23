<?php
namespace Deployer;

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', false);

set('repository', 'git@github.com:shynixxx/my-project.git');

add('writable_dirs', ['public']);

set('default_stage', 'dev');

// Servers

server('dev', 'dev2.ylly.fr')
    ->user('ylly')
    ->identityFile()
    ->set('deploy_path', '/var/www/p/circle_ci_test/');

task('deploy', [
    'ask_git_version',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:shared',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

task('ask_git_version', function() {
    $tags = explode("\n", runLocally('git tag'));
    if (count($tags) > 0)
        set('branch', $tags[count($tags) - 1]);
    $branch = ask('Version to deploy', get('branch'));
    set('branch', $branch);
});


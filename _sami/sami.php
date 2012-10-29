<?php

require __DIR__.'/../vendor/autoload.php';

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$projectDir = __DIR__.'/../../lifestream';
$src        = $projectDir.'/Lifestream';
$name       = 'Lifestream Api';
$branches   = array(
    'master' => 'Master',
);

/** Common Code */

if (!file_exists($projectDir)) {
    throw new Exception(sprintf('Directory "%s" does no exists', $projectDir));
}
$projectDir = realpath($projectDir);

$samiCache = getenv('HOME').'/'.'.sami';
if (!file_exists($samiCache)) {
    mkdir($samiCache);
}

$projectCachePath     = $samiCache.'/'.str_replace('/', '-', $projectDir);
$projectCacheSrcPath  = $projectCachePath.'/src';
$projectCacheSamiPath = $projectCachePath.'/cache';

$git_cmd = function($cmd) use ($projectCacheSrcPath) {
    return exec(sprintf(
        'git --git-dir=%s --work-tree=%s %s >/dev/null 2>&1',
        $projectCacheSrcPath.'/.git',
        $projectCacheSrcPath,
        $cmd
    ));
};

if (!file_exists($projectCacheSrcPath)) {
    exec(sprintf('git clone %s %s', $projectDir, $projectCacheSrcPath));
} else {
    $git_cmd('fetch');
}

foreach (array_keys($branches) as $branch) {
    $git_cmd('branch '.$branch);
    $git_cmd('checkout '.$branch);
    $git_cmd('reset --hard origin/'.$branch);
}

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Tests')
    ->in($projectCacheSrcPath)
;

$versions = GitVersionCollection::create($projectCacheSrcPath);
foreach ($branches as $key => $value) {
    $versions->add($key, $value);
}

return new Sami($iterator, array(
    'theme'                => 'lyrixx',
    'versions'             => $versions,
    'title'                => $name,
    'build_dir'            => __DIR__.'/../api/%version%',
    'cache_dir'            => $projectCacheSamiPath.'/%version%',
    'template_dirs'        => array(__DIR__.'/theme/lyrixx'),
    'default_opened_level' => 2,
));


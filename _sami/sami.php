<?php

require __DIR__.'/../vendor/autoload.php';

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$dir = __DIR__.'/../../lifestream/Lifestream';
$name = 'Lifestream Api';

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Tests')
    ->in($dir)
;

$versions = GitVersionCollection::create($dir)
    ->add('master', 'master branch')
;

return new Sami($iterator, array(
    'theme'                => 'lyrixx',
    'versions'             => $versions,
    'title'                => $name,
    'build_dir'            => __DIR__.'/../api/%version%',
    'cache_dir'            => sys_get_temp_dir().'/sami/cache/lifestream/%version%',
    'template_dirs'     => array(__DIR__.'/theme/lyrixx'),
    'default_opened_level' => 2,
));

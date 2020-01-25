<?php declare(strict_types=1);

use Nette\Loaders;
use Ninjify\Nunjuck\Environment;

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Install Nette Tester using `composer update --dev`';
    die(0);
}

require_once __DIR__ . '/../vendor/autoload.php';

Environment::setupTester();
Environment::setupTimezone();
Environment::setupVariables(__DIR__);
Environment::setupRobotLoader(static function (Loaders\RobotLoader $robotLoader) {
    $robotLoader->addDirectory(__DIR__ . '/engine');
});

define('DATA_DIR', __DIR__ . '/data');

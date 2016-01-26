<?php declare(strict_types=1);

namespace Amplify\Cli;

use Aerys\Host;
use function Aerys\root;

require_once __DIR__ . '/../bootstrap.php';

(new Host)
    ->name('localhost')
    ->expose('*', 8081)
    ->use($router)
    ->use(root(__DIR__ . '/../public'))
;

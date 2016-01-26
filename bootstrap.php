<?php declare(strict_types=1);

namespace Amplify;

use CodeCollab\Template\Html;

require_once __DIR__ . '/vendor/autoload.php';

$template = new Html(__DIR__ . '/templates', '/page.phtml');

require_once __DIR__ . '/routes.php';

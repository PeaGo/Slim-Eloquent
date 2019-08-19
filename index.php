<?
define ('APP_PATH', __DIR__);
require __DIR__ . '/vendor/autoload.php';
$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,
]];
$config = [
    'settings' => [
        'addContentLengthHeader' => false,
        'db' => [
            // Eloquent configuration
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'slim-eloquent',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ],
];


$app = new \Slim\App($config);
$container = $app->getContainer();
// var_dump($container);
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($config['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$table=$capsule->table('users');

// $widgets = $table->get();

// echo '<pre>';
// var_dump($widgets);
// Define app routes
$app->get('/hello', function ($request, $response, $args) {
    return $response->write("Hello, world");
});
foreach (glob(APP_PATH.'/routes/*.php') as $filename)
{
	require $filename;
}

// Run app
$app->run();
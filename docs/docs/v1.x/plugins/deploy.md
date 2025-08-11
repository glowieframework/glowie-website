# Glowie Deploy

This is a plugin for [Glowie Framework](https://github.com/glowieframework/glowie) that allows deploying applications using automated SSH scripts. It supports notifications, tasks, and environment variables.

You can also use Deploy in standalone mode, without the need for a Glowie installation.

## Installation

### In a Glowie project

Install in your Glowie project using Composer:

```shell
composer require glowieframework/deploy
```

Then add the **Deploy** class to the `plugins` array in the `app/config/Config.php` file:

```php
'plugins' => [
    // ... other plugins here
    \Glowie\Plugins\Deploy\Deploy::class,
],
```

Make sure to publish the plugin files with the CLI:

```shell
php firefly publish
```

This will create a `Deploy.php` file in your `app/config` folder. This is where the plugin settings will be stored.

It will also create a `.deploy-tasks.php` file in the root of your application, which is the main entry point for your deploy scripts.

If you want to create the tasks file manually in the current project directory, run:

```shell
php firefly deploy:create
```

### Standalone

You can use Deploy without installing Glowie. Simply download the binary from the [releases page](https://github.com/glowieframework/deploy/releases), give it execute permissions using `chmod +x`, and optionally add it to your system's `PATH` for easier access.

If you already have Composer installed, you can install Deploy globally with the following command:

```shell
composer global require glowie/deploy
```

After that, make sure the Composer global `bin` directory is in your system's PATH so you can run Deploy from anywhere.

To generate the `.deploy-tasks.php` file in the current working directory, run:

```shell
deploy create
```

To specify a different location, use the `--path` option.

## Configuration

### In a Glowie project

When you publish the plugin files, a configuration file named `Deploy.php` will be created in your `app/config` folder. This file is responsible for defining your deploy servers and notification settings.

> [!CAUTION]
> Never store sensitive credentials (like passwords or API keys) directly in this file. Always use environment variables.

### Standalone

You can create a configuration file by running:

```shell
deploy config
```

This will generate a `config.php` file in the current working directory. To specify a different location, use the `--path` option.

### Servers

Under the `servers` key, you can define an associative array of all servers that will be used in your deploy process. Each server should have a **unique** name as the key, and the corresponding connection settings as the value.

```php
'servers' => [

    'localhost' => [
        'local' => true, // Marks this server as local deployment (no SSH)
        'env' => [] // (Optional) Associative array of environment variables to expose to the server
    ],

    'web' => [
        'host' => Env::get('DEPLOY_SSH_HOST'), // SSH hostname or IP address
        'port' => Env::get('DEPLOY_SSH_PORT', 22), // SSH port (defaults to 22)
        'user' => Env::get('DEPLOY_SSH_USER', 'root'), // SSH user name
        'env' => [] // (Optional) Associative array of environment variables to expose to the server
    ],

    // ... other servers can go here

],
```

### Notifications

The `notifications` section allows you to configure services to receive real-time updates during the deploy process. Each supported service accepts an API key or webhook URL. Read more about **Notifications** below.

## Writing tasks

Your deploy tasks must be written in the `.deploy-tasks.php` file. A task is a PHP function that will be called in the deploy lifecycle.

To run shell commands in the target servers, use:

```php
public function deploy(){

    $this->command('cd /var/www/my-project');

    $this->command('git pull');

    $this->command('php firefly migrate');

}
```

Each command will run in order and wait for the previous command to finish before its execution. If a remote command fails or returns a **non-zero** exit code, an exception will be thrown and the script execution will stop.

The output of each command will be printed to the terminal upon execution.

### Specifying the target server

By default, all commands will run in all servers from the config file. If you want to run a command in a single server, pass the server name as the second argument of the `command()` method. You can also use an array of server names.

```php
// Runs only in "homologation" server
$this->command('cd /var/www/my-project', 'homologation');

// Runs in both "homologation" and "production" servers
$this->command('git pull', ['homologation', 'production']);
```

You can also enclose a set of commands to run on a specific server (or an array of servers) by using the following syntax:

```php
$this->on('production', function() {
    $this->command('cd /var/www/production-folder');
    $this->command('git pull');
});
```

### Printing messages in the console

To print a custom message in the console, use:

```php
$this->print('My custom message');
```

You can also pass an optional color name as the second argument or use one of the aliases:

```php
$this->error('Something failed!');

$this->success('Everything works great.');

$this->warning('Be careful...');

$this->info('Running build...');
```

### Before initialization

If you want to perform an action before your task runs, define the following method in your tasks file:

```php
public function init(string $task){
    // You can do anything here
    $this->info("Starting $task...");
}
```

The method will receive the task name as the first parameter.

### After success

If you want to do something when your task ends the execution with success (no command returned a code greater than `0`), create the following method in the tasks file:

```php
public function done(string $task){
    // You can do anything here
    $this->success("$task ran successfully!");
}
```

The method will receive the task name as the first parameter.

### Handling errors

If something in your task fails, the script execution will stop and an exception will be thrown. If you want to capture the error and do something with it (like sending a notification), create the following method in the tasks file:

```php
public function fail(string $task, Throwable $th){
    // You can do anything here
    $this->error("$task failed! Stack trace:");
    $this->error($th->getTraceAsString());
}
```

The method will receive the task name as the first parameter, and the exception as the second. This method is called for errors in any task from the tasks file.

## Setting environment variables

You can expose environment variables to the target servers using the `env()` method. This method allows you to add or override environment variables defined in the config file.

```php
$this->env('custom_env', 'custom_value');
```

> [!NOTE]
> Environment variables exposed using this method are shared across all servers.

## Running a deploy task

### In a Glowie project

Open the terminal in the root of your application and run:

```shell
php firefly deploy:run
```

This will run the default `deploy()` task. If you want to run another task, pass the task name as:

```shell
php firefly deploy:run --task=myTask
```

Alternatively, you can also specify the target tasks file, if you are not using the default `.deploy-tasks.php` in the current working directory:

```shell
php firefly deploy:run --path=/path/to/.deploy-tasks.php
```

You can also specify a custom config file if you're not using the default one:

```shell
php firefly deploy:run --config=/path/to/config.php
```

### Standalone

All commands above can be executed directly without using the `php firefly deploy` prefix, as long as the binary is properly installed and accessible from your system's `PATH`.

```shell
deploy run
```

This will run in the current working directory, regardless of its location.

### Passing CLI arguments and options

If you want to pass a custom argument to the task, just send it in the terminal using the syntax:

```shell
php firefly deploy:run --version=1.0.0
```

To get this argument value from within your tasks file, use:

```php
$version = $this->getArg('version'); // returns "1.0.0"
```

You can also pass custom options:

```shell
php firefly deploy:run -production
```

And retrieve from your task:

```php
$isProduction = $this->hasOption('production'); // returns true
```

## Working with stories

A _story_ is a group of tasks executed in order during the deployment process, useful for organizing and isolating specific steps or operations.

It works the same way as a deploy task. To define a story in the tasks file, create a PHP function with the name of the story. Example:

```php
public function pipeline(){

    $this->task('setup_server');

    $this->task('clone_repository');

    $this->task('build_application');

    $this->task('clear_cache');

}
```

> [!IMPORTANT]
> The story method must not execute shell operations directly. Instead, it should invoke other task methods to perform those operations.

### Running a story

To run a deploy story from the CLI, use the following command:

```shell
php firefly deploy:story --name=pipeline
```

The `name` argument should match the name of the story function you want to call.

### Before initialization

If you want to perform an action before your story runs, define the following method in your tasks file:

```php
public function initStory(string $story){
    // You can do anything here
    $this->info("Starting $story...");
}
```

The method will receive the story name as the first parameter.

### After success

If you want to do something when your story ends the execution with success (no command returned a code greater than `0`), create the following method in the tasks file:

```php
public function doneStory(string $story){
    // You can do anything here
    $this->success("$story ran successfully!");
}
```

The method will receive the story name as the first parameter.

### Handling errors

If something in your story fails, the script execution will stop and an exception will be thrown. If you want to capture the error and do something with it (like sending a notification), create the following method in the tasks file:

```php
public function failStory(string $story, Throwable $th){
    // You can do anything here
    $this->error("$story failed! Stack trace:");
    $this->error($th->getTraceAsString());
}
```

The method will receive the story name as the first parameter, and the exception as the second.

## Notifications

Glowie Deploy also supports sending notifications to some services. You can use this feature to report task progress or errors to your favorite applications.

### Discord

To send a notification as a message to a Discord channel, create a [Discord webhook](https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks) and copy its URL to your app `.env` file:

```env
DEPLOY_DISCORD_URL=https://discord.com/api/webhooks/...
```

Then, in your task, simply call:

```php
$this->notifyDiscord('Write your message to Discord here!');
```

### Slack

To send a notification as a message to a Slack channel, create a [Slack webhook](https://api.slack.com/messaging/webhooks) and copy its URL to your app `.env` file:

```env
DEPLOY_SLACK_URL=https://hooks.slack.com/...
```

Then, in your task, simply call:

```php
$this->notifySlack('Write your message to Slack here!');
```

### Telegram

To send a notification as a message to a Telegram chat, first create a Telegram bot and grab its ID using [BotFather](https://t.me/botfather). Second, grab the destination chat ID using [IDBot](https://t.me/username_to_id_bot). After that, copy both IDs to your app `.env` file:

```env
DEPLOY_TELEGRAM_BOT_ID=...
DEPLOY_TELEGRAM_CHAT_ID=...
```

Then, in your task, simply call:

```php
$this->notifyTelegram('Write your message to Telegram here!');
```

### Push notifications (with Alertzy)

To send a message as a push notification to your phone, download the [Alertzy](https://alertzy.app) app on your phone and create an account. Then, grab your account key in the app and copy to your `.env` file:

```env
DEPLOY_PUSH_KEY=...
```

Then, in your task, simply call:

```php
$this->notifyPush('Write a message to your phone here!');
```

> [!NOTE]
> Alertzy has a limit of **100 push notifications per day**. After that limit is reached, notifications will stop being delivered.

## Credits

Deploy and Glowie are actively developed by [Gabriel Silva](https://gabrielsilva.dev.br).
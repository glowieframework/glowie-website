<?php

/**
 * Gets a configuration variable.
 * @param string $key Configuration key to get.
 * @param mixed $default (Optional) Default value to return if not found.
 * @return mixed Returns the configuration variable or the default value if not found.
 */
function get_config(string $key, $default = null)
{
    return ButterDocs::getConfig($key, $default);
}

/**
 * Gets a language string.
 * @param string $key Language key to get.
 * @param string $default (Optional) Default string to return if not found.
 * @return string Returns the language string or the default if not found.
 */
function get_lang(string $key, string $default = '')
{
    static $__langStrings = null;
    if (is_null($__langStrings)) {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
        $filename = __DIR__ . "/../lang/{$lang}.php";
        $__langStrings = is_file($filename) ? require_once($filename) : [];
    }
    return $__langStrings[$key] ?? $default;
}

/**
 * Renders a view file.
 * @param string $filename View filename.
 * @param array $parameters (Optional) Associative array of parameters to pass to the view.
 */
function view(string $filename, array $parameters = [])
{
    ob_start();
    extract($parameters);
    if (substr($filename, -6) !== '.phtml') $filename .= '.phtml';
    include(__DIR__ . '/../view/' . $filename);
    echo ob_get_clean();
}

<?php

namespace NoelClick\PhpDotEnv;

/**
 * Handles environment variables.
 * @author @NoelClick
 * @copyright 2022 by Noel Kayabasli
 */
class DotEnv
{

    /**
     * The directory where the .env file is located in.
     * @var string
     */
    protected string $path;

    /**
     * @param string $path - Path to the .env file.
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        $this->path = $path;
    }

    /**
     * Loads and reads the .env file to set environment variables which can be accessed with the $\_ENV['VARIABLE'] and $\_SERVER['VARIABLE'] arrays or with the getenv('VARIABLE') function (slower).
     * @see $_ENV, $_SERVER, getenv() (slower)
     * @return void
     */
    public function load() :void
    {
        if (!is_readable($this->path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $valueArray = str_split($value);
            if ($valueArray[0] === $valueArray[count($valueArray)-1]) {
                if ($valueArray[0] === "'" || $valueArray[0] === '"' || $valueArray[0] === "`") {
                    $value = trim(substr($value, 1, -1));
                }
            }
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }

}
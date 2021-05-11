<?php

namespace CERF\Database;

use \PDO;
use \PDOException;

class DB
{
    protected static PDO|null $instance = null;
    protected static PDOException|null $error = null;

    public static function getInstance(): ?PDO
    {
        try {
            if (is_null(self::$instance)) {
                $database = config('database');

                self::$instance = new PDO(
                    $database['driver'] . ":host=" . $database['host'] . ";dbname=" . $database['dbname'] . ";port=" . $database['port'],
                    $database['username'],
                    $database['passwd'],
                    $database['options']
                );
            }
        } catch (\PDOException $error) {
            self::$error;
        }

        return self::$instance;
    }

    public static function getError(): ? PDOException
    {
        return self::$error;
    }

}

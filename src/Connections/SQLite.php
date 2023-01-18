<?php

namespace DatabaseFactory\Connections {

    use DatabaseFactory\Contracts;

    /**
     * The SQLSrv connection class handles the connection to a
     * MSSQL database
     *
     * @package DatabaseFactory\Connections
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class SQLite implements Contracts\ConnectionInterface
    {
        /** @var string $driver Database Driver */
        protected static string $driver = 'sqlite';

        /**
         * Sets the connection string and returns it
         *
         * @param string $database Database name
         * @param string $hostname Database host
         *
         * @return string
         */
        public static function connection(string $database, string $hostname): string
        {
            return self::$driver . str_ends_with($database, '.db') ? ":$database" : ":$database.db";
        }
    }
}

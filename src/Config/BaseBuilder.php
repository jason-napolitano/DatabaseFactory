<?php

namespace DatabaseFactory\Config {

    use DatabaseFactory\Helpers;
    use DatabaseFactory\Contracts;

    /**
     * SQL Module DB
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class BaseBuilder implements Contracts\BaseBuilderInterface
    {

        final protected const COUNT = 'COUNT';
        final protected const WHERE = ' WHERE ';
        final protected const LIKE = ' LIKE ';
        final protected const ORDER_BY = ' ORDER BY ';
        final protected const GROUP_BY = ' GROUP BY ';
        final protected const SELECT = 'SELECT';
        final protected const INSERT = 'INSERT ';
        final protected const UPDATE = 'UPDATE ';
        final protected const DELETE = 'DELETE ';
        final protected const JOIN = ' JOIN ';
        final protected const OFFSET = ' OFFSET';
        final protected const LIMIT = ' LIMIT';
        final protected const OR_NOT = ' OR NOT ';
        final protected const FROM = ' FROM ';
        final protected const NOT = ' <>';
        final protected const AND = ' AND ';
        final protected const SEPARATOR = ', ';
        final protected const BKTK = '`';
        final protected const EQUALS = ' = ';
        final protected const COMMA = ',';
        final protected const SPC = ' ';
        final protected const EMPTY = '';
        final protected const SGLQT = "'";
        final protected const DBLQT = '"';
        final protected const PRD = '.';
        final protected const ON = ' ON ';
        final protected const OR = ' OR ';
        final protected const TRUE = 'TRUE';
        final protected const FALSE = 'FALSE';
        final protected const ZERO = 0;
        final protected const ONE = 1;
        final protected const ASC = 'ASC';
        final protected const DESC = 'DESC';
        final protected const OPPAR = '(';
        final protected const CLPAR = ')';
        final protected const VALUE = '`?`';
        final protected const ALL = '*';
        final protected const PERC = '%';

        /**
         * Strip a string of quotes
         *
         * @param string $string
         *
         * @return string
         */
        protected static function strip(string $string): string
        {
            return Helpers\Str::stripQuotes($string, true);
        }

        /**
         * Add double quotes to a string
         *
         * @param string $string
         *
         * @return string
         */
        protected static function doubleQuote(string $string): string
        {
            return self::DBLQT . Helpers\Str::stripQuotes($string) . self::DBLQT;
        }

        /**
         * Add single quotes to a string
         *
         * @param string $string
         *
         * @return string
         */
        protected static function singleQuote(string $string): string
        {
            return self::SGLQT . Helpers\Str::stripQuotes($string) . self::SGLQT;
        }

        /**
         * Increment a value
         *
         * @param int $value
         *
         * @return int
         */
        protected static function increment(int $value = 0): int
        {
            return $value + self::ONE;
        }

        /**
         * Decrement a value
         *
         * @param int $value
         *
         * @return int
         */
        protected static function decrement(int $value = 0): int
        {
            return $value - self::ONE;
        }
        public static function contains(string $field, $value): string
        {
            return self::WHERE . 'find_in_set' . self::OPPAR . self::SGLQT . $value . self::SGLQT . self::SEPARATOR . $field . self::CLPAR > 0;
        }

        public static function where(string $columns): string
        {
            return static::WHERE . $columns;
        }

        public static function like(string $pattern, bool $not = false): string
        {
            $notStr = $not ? self::NOT : self::EMPTY;
            return $notStr . self::LIKE . static::SGLQT . self::PERC . $pattern . self::PERC . static::SGLQT;
        }

        public static function select(string $columns, bool $space = false): string
        {
            $select = $space ? self::SPC : self::EMPTY;
            return self::SELECT . self::SPC . $columns . $select;
        }

        public static function limit(int $rows): string
        {
            return self::LIMIT . self::SPC . $rows;
        }

        public static function offset(int $count): string
        {
            return self::OFFSET . self::SPC . $count;
        }

        public static function count($values = self::ALL): string
        {
            return self::COUNT . self::OPPAR . $values . self::CLPAR;
        }

        public static function values(array $values): string
        {
            $string = self::OPPAR;
            foreach ($values as $value) {
                $string .= self::VALUE . self::SEPARATOR;
            }
            $string .= self::CLPAR;
            return str_replace($string, '?`, )', '?`)');
        }

        public static function columns(array $columns): string
        {
            return rtrim($columns[0], self::SEPARATOR);
        }

        public static function from(string $table = null): string
        {
            return self::FROM . $table ? : '';
        }

        public static function join(string $params, array $on): string
        {
            return static::SPC . static::JOIN . $params . self::ON . rtrim(implode(self::EQUALS, $on), self::EQUALS);
        }
    }
}
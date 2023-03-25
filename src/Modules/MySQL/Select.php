<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Modules\BaseBuilder;

    /**
     * SQL SELECT
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Select extends BaseBuilder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return
                self::select($params[0] ? : '*') .
                self::from($table);
        }
    }
}
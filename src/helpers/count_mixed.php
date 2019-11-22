<?php

if(!(function_exists('count_mixed'))) {

/**
 * Handle all parameters types like count() used to do before PHP 7.2.
 * Usage recommended only temporarily for upgrading PHP.
 *
 * @param mixed $value
 * @return integer
 *
 * @throws InvalidArgumentException
 */
    function count_mixed($value) {
        if(empty($value)) {
            return 0;
        }

        if(is_scalar($value)) {
            return 1;
        }

        if(is_array($value)) {
            return count($value);
        }

        if(is_object($value)) {

            if(is_countable($value)) {
                return count($value);
            }

            $count = 0;
            foreach($value as $_) {
                $count++;
            }

            return $count;
        }

        throw new InvalidArgumentException('Error when counting mixed, bad parameter '.dump($value));
    }
}
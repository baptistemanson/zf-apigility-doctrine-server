<?php

namespace ZF\Apigility\Doctrine\Server\Collection\Filter\ODM;

use ZF\Apigility\Doctrine\Server\Collection\Filter\FilterInterface;

class Like implements FilterInterface
{
    public function filter($queryBuilder, $option) {
        $queryType = 'addAnd';
        if (isset($option['where'])) {
            if ($option['where'] == 'and') {
                $queryType = 'addAnd';
            } elseif ($option['where'] == 'or') {
                $queryType = 'addOr';
            }
        }

        $regex = '/' . str_replace('%', '.*?', $option['value']) . '/i';
        $queryBuilder->$queryType($queryBuilder->expr()->field($option['field'])->equals(new \MongoRegex($regex)));
    }
}

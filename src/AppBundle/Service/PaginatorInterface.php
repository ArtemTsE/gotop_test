<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 28.03.18
 * Time: 19:18
 */

namespace AppBundle\Service;


interface PaginatorInterface
{
    public function paginate($data);
}
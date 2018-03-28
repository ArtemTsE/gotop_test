<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class Paginator implements PaginatorInterface
{
    /**
     * PAGE const.
     */
    const PAGE = 1;

    /**
     * PER_PAGE const.
     */
    const PER_PAGE = 5;

    /**
     * @var $request
     */
    private $_request;

    /**
     * Paginator constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->_request = $requestStack->getCurrentRequest();
    }

    /**
     * Paginates diff. data
     *
     * @param $data
     * @param $page
     * @param $per_page
     */
    public function paginate($data = [])
    {
        if (!$data) {
            return [];
        }

        $requestQuery = $this->_request->query;

        if (
            ($requestQuery->has('page') && is_numeric($requestQuery->get('page'))) ||
            ($requestQuery->has('per_page') && is_numeric($requestQuery->get('per_page')))
        ) {
            $page     = abs($requestQuery->getInt('page', self::PAGE)) ?: self::PAGE;
            $per_page = abs($requestQuery->getInt('per_page', self::PER_PAGE)) ?: self::PER_PAGE;
        }

        if (!isset($page) || !isset($per_page)) {
            return $data;
        }

        $data = array_slice($data, (--$page * $per_page), $per_page);

        return $data;
    }
}
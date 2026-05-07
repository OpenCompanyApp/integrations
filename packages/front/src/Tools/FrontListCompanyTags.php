<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List company-level Front tags.
 */
class FrontListCompanyTags extends AbstractFrontTool
{
    protected const NAME = 'front_list_company_tags';
    protected const DESCRIPTION = 'List company-level Front tags.';
    protected const METHOD = 'GET';
    protected const PATH = '/company/tags';
    protected const QUERY_KEYS = ['limit', 'page_token', 'sort_by', 'sort_order'];
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field. Front currently supports id.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
    ];
}

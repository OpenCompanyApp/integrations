<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List Front tags accessible to the API token.
 */
class FrontListTags extends AbstractFrontTool
{
    protected const NAME = 'front_list_tags';
    protected const DESCRIPTION = 'List all Front company, team, and teammate tags accessible to the API token.';
    protected const METHOD = 'GET';
    protected const PATH = '/tags';
    protected const QUERY_KEYS = ['limit', 'page_token', 'sort_by', 'sort_order'];
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field. Front currently supports id.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
    ];
}

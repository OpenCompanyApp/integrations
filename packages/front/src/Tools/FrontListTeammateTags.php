<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List tags scoped to a Front teammate.
 */
class FrontListTeammateTags extends AbstractFrontTool
{
    protected const NAME = 'front_list_teammate_tags';
    protected const DESCRIPTION = 'List tags for a Front teammate.';
    protected const METHOD = 'GET';
    protected const PATH = '/teammates/{teammate_id}/tags';
    protected const REQUIRED = ['teammate_id'];
    protected const QUERY_KEYS = ['limit', 'page_token', 'sort_by', 'sort_order'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field. Front currently supports id.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
    ];
}

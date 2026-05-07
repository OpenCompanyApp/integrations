<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List tags scoped to a Front team workspace.
 */
class FrontListTeamTags extends AbstractFrontTool
{
    protected const NAME = 'front_list_team_tags';
    protected const DESCRIPTION = 'List tags for a Front team workspace.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}/tags';
    protected const REQUIRED = ['team_id'];
    protected const QUERY_KEYS = ['limit', 'page_token', 'sort_by', 'sort_order'];
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team workspace ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field. Front currently supports id.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
    ];
}

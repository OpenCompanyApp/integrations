<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List contacts belonging to a Front team workspace.
 */
class FrontListTeamContacts extends AbstractFrontTool
{
    protected const NAME = 'front_list_team_contacts';
    protected const DESCRIPTION = 'List contacts belonging to a Front team workspace.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}/contacts';
    protected const REQUIRED = ['team_id'];
    protected const QUERY_KEYS = ['q', 'limit', 'page_token', 'sort_by', 'sort_order'];
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team workspace ID.'],
        'q' => ['type' => 'string', 'description' => 'Optional query object.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field, such as created_at or updated_at.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
    ];
}

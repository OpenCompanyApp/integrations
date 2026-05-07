<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List private contacts belonging to a Front teammate.
 */
class FrontListTeammateContacts extends AbstractFrontTool
{
    protected const NAME = 'front_list_teammate_contacts';
    protected const DESCRIPTION = 'List contacts belonging to a Front teammate.';
    protected const METHOD = 'GET';
    protected const PATH = '/teammates/{teammate_id}/contacts';
    protected const REQUIRED = ['teammate_id'];
    protected const QUERY_KEYS = ['q', 'limit', 'page_token', 'sort_by', 'sort_order'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
        'q' => ['type' => 'string', 'description' => 'Optional query object.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field, such as created_at or updated_at.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
    ];
}

<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List conversations assigned to a Front teammate.
 */
class FrontListAssignedConversations extends AbstractFrontTool
{
    protected const NAME = 'front_list_assigned_conversations';
    protected const DESCRIPTION = 'List conversations assigned to a Front teammate in reverse chronological order.';
    protected const METHOD = 'GET';
    protected const PATH = '/teammates/{teammate_id}/conversations';
    protected const REQUIRED = ['teammate_id'];
    protected const QUERY_KEYS = ['q', 'limit', 'page_token'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
        'q' => ['type' => 'string', 'description' => 'Optional query object for statuses, status_categories, or status_ids.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
    ];
}

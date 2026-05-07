<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List conversations in a Front inbox.
 */
class FrontListInboxConversations extends AbstractFrontTool
{
    protected const NAME = 'front_list_inbox_conversations';
    protected const DESCRIPTION = 'List conversations in a Front inbox. Use search for more advanced filtering.';
    protected const METHOD = 'GET';
    protected const PATH = '/inboxes/{inbox_id}/conversations';
    protected const REQUIRED = ['inbox_id'];
    protected const QUERY_KEYS = ['q', 'limit', 'page_token'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID.'],
        'q' => ['type' => 'string', 'description' => 'Optional query object for statuses, status_categories, or status_ids.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
    ];
}

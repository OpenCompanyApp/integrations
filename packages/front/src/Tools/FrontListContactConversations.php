<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List conversations associated with a Front contact.
 */
class FrontListContactConversations extends AbstractFrontTool
{
    protected const NAME = 'front_list_contact_conversations';
    protected const DESCRIPTION = 'List conversations for a Front contact in reverse chronological order.';
    protected const METHOD = 'GET';
    protected const PATH = '/contacts/{contact_id}/conversations';
    protected const REQUIRED = ['contact_id'];
    protected const QUERY_KEYS = ['q', 'limit', 'page_token'];
    protected const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID or alias.'],
        'q' => ['type' => 'string', 'description' => 'Optional query object for statuses, status_categories, or status_ids.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
    ];
}

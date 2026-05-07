<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List Front conversations accessible to the API token.
 */
class FrontListConversations extends AbstractFrontTool
{
    protected const NAME = 'front_list_conversations';
    protected const DESCRIPTION = 'List Front conversations. Use q for simple filters, or front_search_conversations for advanced search syntax.';
    protected const METHOD = 'GET';
    protected const PATH = '/conversations';
    protected const QUERY_KEYS = ['q', 'limit', 'page_token', 'page', 'status'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'description' => 'Optional Front search query object or legacy search text.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'page' => ['type' => 'integer', 'description' => 'Legacy page number for older host usage. Prefer page_token when available.'],
        'status' => ['type' => 'string', 'description' => 'Legacy status filter for older host usage. Prefer q or search syntax.'],
    ];
}

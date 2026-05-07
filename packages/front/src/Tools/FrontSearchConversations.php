<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Search Front conversations using Front's search syntax.
 */
class FrontSearchConversations extends AbstractFrontTool
{
    protected const NAME = 'front_search_conversations';
    protected const DESCRIPTION = 'Search conversations using Front search syntax, such as "billing tag:tag_123 is:open".';
    protected const METHOD = 'GET';
    protected const PATH = '/conversations/search/{query_text}';
    protected const REQUIRED = ['query_text'];
    protected const QUERY_KEYS = ['limit', 'page_token'];
    protected const PARAMETERS = [
        'query_text' => ['type' => 'string', 'required' => true, 'description' => 'Front search query text. The tool URL-encodes this value.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
    ];
}

<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List messages in a Front conversation.
 */
class FrontListMessages extends AbstractFrontTool
{
    protected const NAME = 'front_list_messages';
    protected const DESCRIPTION = 'List messages in a Front conversation in reverse chronological order by default.';
    protected const METHOD = 'GET';
    protected const PATH = '/conversations/{conversation_id}/messages';
    protected const REQUIRED = ['conversation_id'];
    protected const QUERY_KEYS = ['limit', 'page_token', 'sort_by', 'sort_order', 'page'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID, such as cnv_123abc.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        'sort_by' => ['type' => 'string', 'description' => 'Sort field. Front currently supports created_at.'],
        'sort_order' => ['type' => 'string', 'enum' => ['asc', 'desc'], 'description' => 'Sort order.'],
        'page' => ['type' => 'integer', 'description' => 'Legacy page number for older host usage. Prefer page_token.'],
    ];
}

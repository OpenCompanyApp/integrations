<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List conversations tagged with a Front tag.
 */
class FrontListTaggedConversations extends AbstractFrontTool
{
    protected const NAME = 'front_list_tagged_conversations';
    protected const DESCRIPTION = 'List conversations tagged with a Front tag.';
    protected const METHOD = 'GET';
    protected const PATH = '/tags/{tag_id}/conversations';
    protected const REQUIRED = ['tag_id'];
    protected const QUERY_KEYS = ['q', 'limit', 'page_token'];
    protected const PARAMETERS = [
        'tag_id' => ['type' => 'string', 'required' => true, 'description' => 'Tag ID.'],
        'q' => ['type' => 'string', 'description' => 'Optional query object for statuses, status_categories, or status_ids.'],
        'limit' => ['type' => 'integer', 'description' => 'Max results per page, up to 100.'],
        'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
    ];
}

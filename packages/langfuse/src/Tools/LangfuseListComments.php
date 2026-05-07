<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse comments.
 */
class LangfuseListComments extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_comments';
    protected const DESCRIPTION = 'List Langfuse comments with object and pagination filters.';
    protected const SERVICE_METHOD = 'listComments';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'objectType', 'objectId', 'authorUserId'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'objectType' => ['type' => 'string', 'description' => 'Filter by commented object type.'],
        'objectId' => ['type' => 'string', 'description' => 'Filter by commented object ID.'],
        'authorUserId' => ['type' => 'string', 'description' => 'Filter by author user ID.'],
    ];
}

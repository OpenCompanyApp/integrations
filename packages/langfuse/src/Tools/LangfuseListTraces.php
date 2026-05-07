<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse traces with filters and pagination.
 */
class LangfuseListTraces extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_traces';
    protected const DESCRIPTION = 'List Langfuse traces with filters such as page, limit, userId, name, sessionId, tags, fromTimestamp, and toTimestamp.';
    protected const SERVICE_METHOD = 'listTraces';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'userId', 'name', 'sessionId', 'fromTimestamp', 'toTimestamp', 'orderBy', 'tags', 'version', 'release'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'userId' => ['type' => 'string', 'description' => 'Filter by user ID.'],
        'name' => ['type' => 'string', 'description' => 'Filter by trace name.'],
        'sessionId' => ['type' => 'string', 'description' => 'Filter by session ID.'],
        'fromTimestamp' => ['type' => 'string', 'description' => 'ISO timestamp lower bound.'],
        'toTimestamp' => ['type' => 'string', 'description' => 'ISO timestamp upper bound.'],
        'orderBy' => ['type' => 'string', 'description' => 'Langfuse trace order expression.'],
        'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Filter by tags.'],
        'version' => ['type' => 'string', 'description' => 'Filter by version.'],
        'release' => ['type' => 'string', 'description' => 'Filter by release.'],
    ];
}

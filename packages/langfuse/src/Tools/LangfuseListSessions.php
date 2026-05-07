<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse sessions.
 */
class LangfuseListSessions extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_sessions';
    protected const DESCRIPTION = 'List Langfuse sessions with pagination and optional user/time filters.';
    protected const SERVICE_METHOD = 'listSessions';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'fromTimestamp', 'toTimestamp', 'userId'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'fromTimestamp' => ['type' => 'string', 'description' => 'ISO timestamp lower bound.'],
        'toTimestamp' => ['type' => 'string', 'description' => 'ISO timestamp upper bound.'],
        'userId' => ['type' => 'string', 'description' => 'Filter by user ID.'],
    ];
}

<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse observations with v2 filters.
 */
class LangfuseListObservations extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_observations';
    protected const DESCRIPTION = 'List Langfuse v2 observations with trace, type, user, session, time, and pagination filters.';
    protected const SERVICE_METHOD = 'listObservations';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'traceId', 'userId', 'sessionId', 'type', 'name', 'fromStartTime', 'toStartTime', 'orderBy'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'traceId' => ['type' => 'string', 'description' => 'Filter by trace ID.'],
        'userId' => ['type' => 'string', 'description' => 'Filter by user ID.'],
        'sessionId' => ['type' => 'string', 'description' => 'Filter by session ID.'],
        'type' => ['type' => 'string', 'description' => 'Observation type filter.'],
        'name' => ['type' => 'string', 'description' => 'Observation name filter.'],
        'fromStartTime' => ['type' => 'string', 'description' => 'ISO start-time lower bound.'],
        'toStartTime' => ['type' => 'string', 'description' => 'ISO start-time upper bound.'],
        'orderBy' => ['type' => 'string', 'description' => 'Langfuse observation order expression.'],
    ];
}

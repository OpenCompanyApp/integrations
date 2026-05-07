<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * List Langfuse v2 scores.
 */
class LangfuseListScores extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_list_scores';
    protected const DESCRIPTION = 'List Langfuse v2 scores with trace, observation, session, user, name, config, data type, and pagination filters.';
    protected const SERVICE_METHOD = 'listScores';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['page', 'limit', 'userId', 'traceId', 'sessionId', 'observationId', 'name', 'fromTimestamp', 'toTimestamp', 'source', 'operator', 'value', 'scoreIds', 'configId', 'dataType'];
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, starts at 1.'],
        'limit' => ['type' => 'integer', 'description' => 'Items per page.'],
        'userId' => ['type' => 'string', 'description' => 'Filter by user ID.'],
        'traceId' => ['type' => 'string', 'description' => 'Filter by trace ID.'],
        'sessionId' => ['type' => 'string', 'description' => 'Filter by session ID.'],
        'observationId' => ['type' => 'string', 'description' => 'Filter by observation ID.'],
        'name' => ['type' => 'string', 'description' => 'Filter by score name.'],
        'fromTimestamp' => ['type' => 'string', 'description' => 'ISO timestamp lower bound.'],
        'toTimestamp' => ['type' => 'string', 'description' => 'ISO timestamp upper bound.'],
        'source' => ['type' => 'string', 'description' => 'Filter by score source.'],
        'operator' => ['type' => 'string', 'description' => 'Comparison operator for value filters.'],
        'value' => ['type' => ['number', 'string', 'boolean'], 'description' => 'Score value filter.'],
        'scoreIds' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Filter by score IDs.'],
        'configId' => ['type' => 'string', 'description' => 'Filter by score config ID.'],
        'dataType' => ['type' => 'string', 'description' => 'Filter by data type.'],
    ];
}

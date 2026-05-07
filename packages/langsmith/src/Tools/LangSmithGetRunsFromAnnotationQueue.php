<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Runs From Annotation Queue.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues/{queue_id}/runs.
 */
class LangSmithGetRunsFromAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_runs_from_annotation_queue';
    protected const DESCRIPTION = 'Get Runs From Annotation Queue

Official endpoint: GET /api/v1/annotation-queues/{queue_id}/runs
Get Runs From Annotation Queue.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: offset, limit, archived, include_stats, status.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'archived' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `archived`.',
  ),
  'include_stats' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_stats`.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `status`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/runs';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
  0 => 'offset',
  1 => 'limit',
  2 => 'archived',
  3 => 'include_stats',
  4 => 'status',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

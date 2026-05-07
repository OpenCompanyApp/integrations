<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Dataset Tracer Sessions.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/datasets/sessions.
 */
class LangSmithReadSharedDatasetTracerSessions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_dataset_tracer_sessions';
    protected const DESCRIPTION = 'Read Shared Dataset Tracer Sessions

Official endpoint: GET /api/v1/public/{share_token}/datasets/sessions
Get projects run on a dataset that has been shared.';
    protected const PARAMETERS = array (
  'share_token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `share_token`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: id, name, name_contains, dataset_version, sort_by, sort_by_desc, sort_by_feedback_key, offset, limit, facets.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name`.',
  ),
  'name_contains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name_contains`.',
  ),
  'dataset_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataset_version`.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
  'sort_by_desc' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by_desc`.',
  ),
  'sort_by_feedback_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by_feedback_key`.',
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
  'facets' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `facets`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/{share_token}/datasets/sessions';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'name',
  2 => 'name_contains',
  3 => 'dataset_version',
  4 => 'sort_by',
  5 => 'sort_by_desc',
  6 => 'sort_by_feedback_key',
  7 => 'offset',
  8 => 'limit',
  9 => 'facets',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

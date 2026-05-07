<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Tracer Sessions.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions.
 */
class LangSmithReadTracerSessions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_tracer_sessions';
    protected const DESCRIPTION = 'Read Tracer Sessions

Official endpoint: GET /api/v1/sessions
Get all sessions.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: reference_free, reference_dataset, id, name, name_contains, dataset_version, sort_by, sort_by_desc, metadata, sort_by_feedback_key, offset, limit, tag_value_id, facets, filter, include_stats, use_approx_stats, stats_start_time, stats_select.',
  ),
  'reference_free' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `reference_free`.',
  ),
  'reference_dataset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `reference_dataset`.',
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
  'metadata' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `metadata`.',
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
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
  'facets' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `facets`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'include_stats' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_stats`.',
  ),
  'use_approx_stats' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `use_approx_stats`.',
  ),
  'stats_start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `stats_start_time`.',
  ),
  'stats_select' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `stats_select`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'reference_free',
  1 => 'reference_dataset',
  2 => 'id',
  3 => 'name',
  4 => 'name_contains',
  5 => 'dataset_version',
  6 => 'sort_by',
  7 => 'sort_by_desc',
  8 => 'metadata',
  9 => 'sort_by_feedback_key',
  10 => 'offset',
  11 => 'limit',
  12 => 'tag_value_id',
  13 => 'facets',
  14 => 'filter',
  15 => 'include_stats',
  16 => 'use_approx_stats',
  17 => 'stats_start_time',
  18 => 'stats_select',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

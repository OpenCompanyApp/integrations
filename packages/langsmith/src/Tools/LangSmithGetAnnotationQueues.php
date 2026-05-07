<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Annotation Queues.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues.
 */
class LangSmithGetAnnotationQueues extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_annotation_queues';
    protected const DESCRIPTION = 'Get Annotation Queues

Official endpoint: GET /api/v1/annotation-queues
Get Annotation Queues.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: ids, name, name_contains, offset, limit, tag_value_id, dataset_id, queue_type, assigned_to_me, sort_by, sort_by_desc.',
  ),
  'ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ids`.',
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
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataset_id`.',
  ),
  'queue_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `queue_type`.',
  ),
  'assigned_to_me' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `assigned_to_me`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'ids',
  1 => 'name',
  2 => 'name_contains',
  3 => 'offset',
  4 => 'limit',
  5 => 'tag_value_id',
  6 => 'dataset_id',
  7 => 'queue_type',
  8 => 'assigned_to_me',
  9 => 'sort_by',
  10 => 'sort_by_desc',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Size From Annotation Queue.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues/{queue_id}/size.
 */
class LangSmithGetSizeFromAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_size_from_annotation_queue';
    protected const DESCRIPTION = 'Get Size From Annotation Queue

Official endpoint: GET /api/v1/annotation-queues/{queue_id}/size
Get Size From Annotation Queue.';
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
    'description' => 'Query string parameters. Known keys: status.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `status`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/size';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
  0 => 'status',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

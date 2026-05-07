<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Run From Annotation Queue.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues/{queue_id}/run/{index}.
 */
class LangSmithGetRunFromAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_run_from_annotation_queue';
    protected const DESCRIPTION = 'Get Run From Annotation Queue

Official endpoint: GET /api/v1/annotation-queues/{queue_id}/run/{index}
Get a run from an annotation queue';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'index' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `index`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: include_extra.',
  ),
  'include_extra' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_extra`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/run/{index}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
  1 => 'index',
);
    protected const QUERY_KEYS = array (
  0 => 'include_extra',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

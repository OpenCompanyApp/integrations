<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Annotation Queue.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues/{queue_id}.
 */
class LangSmithGetAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_annotation_queue';
    protected const DESCRIPTION = 'Get Annotation Queue

Official endpoint: GET /api/v1/annotation-queues/{queue_id}
Get Annotation Queue.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

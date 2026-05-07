<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Annotation Queue.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/annotation-queues/{queue_id}.
 */
class LangSmithUpdateAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_annotation_queue';
    protected const DESCRIPTION = 'Update Annotation Queue

Official endpoint: PATCH /api/v1/annotation-queues/{queue_id}
Update Annotation Queue.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

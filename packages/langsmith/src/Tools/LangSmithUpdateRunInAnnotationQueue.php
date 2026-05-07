<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Run In Annotation Queue.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/annotation-queues/{queue_id}/runs/{queue_run_id}.
 */
class LangSmithUpdateRunInAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_run_in_annotation_queue';
    protected const DESCRIPTION = 'Update Run In Annotation Queue

Official endpoint: PATCH /api/v1/annotation-queues/{queue_id}/runs/{queue_run_id}
Update Run In Annotation Queue.';
    protected const PARAMETERS = array (
  'queue_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_id`.',
  ),
  'queue_run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_run_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/runs/{queue_run_id}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
  1 => 'queue_run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

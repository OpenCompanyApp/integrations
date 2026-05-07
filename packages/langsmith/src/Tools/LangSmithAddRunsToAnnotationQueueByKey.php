<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add Runs To Annotation Queue By Key.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/annotation-queues/{queue_id}/runs/by-key.
 */
class LangSmithAddRunsToAnnotationQueueByKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_add_runs_to_annotation_queue_by_key';
    protected const DESCRIPTION = 'Add Runs To Annotation Queue By Key

Official endpoint: POST /api/v1/annotation-queues/{queue_id}/runs/by-key
Add Runs To Annotation Queue By Key.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/runs/by-key';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

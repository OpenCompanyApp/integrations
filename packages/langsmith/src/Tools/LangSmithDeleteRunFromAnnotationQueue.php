<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Run From Annotation Queue.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/annotation-queues/{queue_id}/runs/{queue_run_id}.
 */
class LangSmithDeleteRunFromAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_run_from_annotation_queue';
    protected const DESCRIPTION = 'Delete Run From Annotation Queue

Official endpoint: DELETE /api/v1/annotation-queues/{queue_id}/runs/{queue_run_id}
Delete Run From Annotation Queue.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/runs/{queue_run_id}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
  1 => 'queue_run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

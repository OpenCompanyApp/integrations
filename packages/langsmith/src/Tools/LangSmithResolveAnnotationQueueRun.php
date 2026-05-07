<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Resolve Annotation Queue Run.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues/{queue_id}/runs/resolve/{queue_run_id}.
 */
class LangSmithResolveAnnotationQueueRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_resolve_annotation_queue_run';
    protected const DESCRIPTION = 'Resolve Annotation Queue Run

Official endpoint: GET /api/v1/annotation-queues/{queue_id}/runs/resolve/{queue_run_id}
Resolve a queue run ID to its section and run data for deep linking.';
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
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/runs/resolve/{queue_run_id}';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
  1 => 'queue_run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

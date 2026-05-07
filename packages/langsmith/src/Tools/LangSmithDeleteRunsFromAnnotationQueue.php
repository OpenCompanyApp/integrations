<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Runs From Annotation Queue.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/annotation-queues/{queue_id}/runs/delete.
 */
class LangSmithDeleteRunsFromAnnotationQueue extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_runs_from_annotation_queue';
    protected const DESCRIPTION = 'Delete Runs From Annotation Queue

Official endpoint: POST /api/v1/annotation-queues/{queue_id}/runs/delete
Delete Runs From Annotation Queue.';
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
    protected const PATH = '/api/v1/annotation-queues/{queue_id}/runs/delete';
    protected const PATH_PARAMS = array (
  0 => 'queue_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Identity Annotation Queue Run Status.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/annotation-queues/status/{annotation_queue_run_id}.
 */
class LangSmithCreateIdentityAnnotationQueueRunStatus extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_identity_annotation_queue_run_status';
    protected const DESCRIPTION = 'Create Identity Annotation Queue Run Status

Official endpoint: POST /api/v1/annotation-queues/status/{annotation_queue_run_id}
Create Identity Annotation Queue Run Status.';
    protected const PARAMETERS = array (
  'annotation_queue_run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `annotation_queue_run_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/annotation-queues/status/{annotation_queue_run_id}';
    protected const PATH_PARAMS = array (
  0 => 'annotation_queue_run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

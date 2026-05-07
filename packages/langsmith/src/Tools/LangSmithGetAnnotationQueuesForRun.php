<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Annotation Queues For Run.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/annotation-queues/{run_id}/queues.
 */
class LangSmithGetAnnotationQueuesForRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_annotation_queues_for_run';
    protected const DESCRIPTION = 'Get Annotation Queues For Run

Official endpoint: GET /api/v1/annotation-queues/{run_id}/queues
Get Annotation Queues For Run.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/annotation-queues/{run_id}/queues';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Queue Metrics.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/metrics/queue/{queue_name}.
 */
class LangSmithGetQueueMetrics extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_queue_metrics';
    protected const DESCRIPTION = 'Get Queue Metrics

Official endpoint: GET /api/v1/metrics/queue/{queue_name}
Return cached SAQ queue counts for the requested queue.';
    protected const PARAMETERS = array (
  'queue_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `queue_name`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/metrics/queue/{queue_name}';
    protected const PATH_PARAMS = array (
  0 => 'queue_name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

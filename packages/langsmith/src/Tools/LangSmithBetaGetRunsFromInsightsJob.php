<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Get Runs From Insights Job.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}/insights/{job_id}/runs.
 */
class LangSmithBetaGetRunsFromInsightsJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_get_runs_from_insights_job';
    protected const DESCRIPTION = '[Beta] Get Runs From Insights Job

Official endpoint: GET /api/v1/sessions/{session_id}/insights/{job_id}/runs
Get all runs for a cluster job, optionally filtered by cluster.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: cluster_id, limit, offset, attribute_sort_key, attribute_sort_order.',
  ),
  'cluster_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `cluster_id`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'attribute_sort_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `attribute_sort_key`.',
  ),
  'attribute_sort_order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `attribute_sort_order`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/{job_id}/runs';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'job_id',
);
    protected const QUERY_KEYS = array (
  0 => 'cluster_id',
  1 => 'limit',
  2 => 'offset',
  3 => 'attribute_sort_key',
  4 => 'attribute_sort_order',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

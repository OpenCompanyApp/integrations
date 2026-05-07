<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Get Run Cluster From Insights Job.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/sessions/{session_id}/insights/{job_id}/clusters/{cluster_id}.
 */
class LangSmithBetaGetRunClusterFromInsightsJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_get_run_cluster_from_insights_job';
    protected const DESCRIPTION = '[Beta] Get Run Cluster From Insights Job

Official endpoint: GET /api/v1/sessions/{session_id}/insights/{job_id}/clusters/{cluster_id}
Get a specific cluster for a session.';
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
  'cluster_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `cluster_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/{job_id}/clusters/{cluster_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'job_id',
  2 => 'cluster_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

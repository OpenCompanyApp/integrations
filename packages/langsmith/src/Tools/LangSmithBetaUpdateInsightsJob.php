<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Update Insights Job.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/sessions/{session_id}/insights/{job_id}.
 */
class LangSmithBetaUpdateInsightsJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_update_insights_job';
    protected const DESCRIPTION = '[Beta] Update Insights Job

Official endpoint: PATCH /api/v1/sessions/{session_id}/insights/{job_id}
Update a session cluster job.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/{job_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'job_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

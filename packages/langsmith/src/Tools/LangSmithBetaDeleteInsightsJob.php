<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * [Beta] Delete Insights Job.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/sessions/{session_id}/insights/{job_id}.
 */
class LangSmithBetaDeleteInsightsJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_beta_delete_insights_job';
    protected const DESCRIPTION = '[Beta] Delete Insights Job

Official endpoint: DELETE /api/v1/sessions/{session_id}/insights/{job_id}
Delete a session cluster job.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/sessions/{session_id}/insights/{job_id}';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
  1 => 'job_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Job Logs.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs.
 */
class LangSmithListJobLogs extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_job_logs';
    protected const DESCRIPTION = 'List Job Logs

Official endpoint: GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs
List all logs for a specific prompt optimization job.';
    protected const PARAMETERS = array (
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs';
    protected const PATH_PARAMS = array (
  0 => 'job_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

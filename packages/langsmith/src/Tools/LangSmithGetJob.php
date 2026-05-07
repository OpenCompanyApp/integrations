<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Job.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}.
 */
class LangSmithGetJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_job';
    protected const DESCRIPTION = 'Get Job

Official endpoint: GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}
Get a specific optimization job.';
    protected const PARAMETERS = array (
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}';
    protected const PATH_PARAMS = array (
  0 => 'job_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

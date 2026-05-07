<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Job.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}.
 */
class LangSmithUpdateJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_job';
    protected const DESCRIPTION = 'Update Job

Official endpoint: PATCH /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}
Replace an existing prompt optimization job with a new, modified job.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}';
    protected const PATH_PARAMS = array (
  0 => 'job_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

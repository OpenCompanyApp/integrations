<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Job.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}.
 */
class LangSmithDeleteJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_job';
    protected const DESCRIPTION = 'Delete Job

Official endpoint: DELETE /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}
Delete a prompt optimization job.';
    protected const PARAMETERS = array (
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}';
    protected const PATH_PARAMS = array (
  0 => 'job_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

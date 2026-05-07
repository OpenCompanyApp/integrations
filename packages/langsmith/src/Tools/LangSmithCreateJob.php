<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Job.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/repos/{owner}/{repo}/optimization-jobs.
 */
class LangSmithCreateJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_job';
    protected const DESCRIPTION = 'Create Job

Official endpoint: POST /api/v1/repos/{owner}/{repo}/optimization-jobs
Create a new prompt optimization job.';
    protected const PARAMETERS = array (
  'repo' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `repo`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs';
    protected const PATH_PARAMS = array (
  0 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

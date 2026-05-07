<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Log.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs.
 */
class LangSmithCreateLog extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_log';
    protected const DESCRIPTION = 'Create Log

Official endpoint: POST /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs
Create a new log entry for a prompt optimization job.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs';
    protected const PATH_PARAMS = array (
  0 => 'job_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

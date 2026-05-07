<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Log.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id}.
 */
class LangSmithGetLog extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_log';
    protected const DESCRIPTION = 'Get Log

Official endpoint: GET /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id}
Get a specific prompt optimization job log.';
    protected const PARAMETERS = array (
  'log_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `log_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id}';
    protected const PATH_PARAMS = array (
  0 => 'log_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

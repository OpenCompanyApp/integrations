<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Log.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id}.
 */
class LangSmithDeleteLog extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_log';
    protected const DESCRIPTION = 'Delete Log

Official endpoint: DELETE /api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id}
Delete a prompt optimization job log.';
    protected const PARAMETERS = array (
  'log_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `log_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs/{job_id}/logs/{log_id}';
    protected const PATH_PARAMS = array (
  0 => 'log_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

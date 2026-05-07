<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Jobs.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/repos/{owner}/{repo}/optimization-jobs.
 */
class LangSmithListJobs extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_jobs';
    protected const DESCRIPTION = 'List Jobs

Official endpoint: GET /api/v1/repos/{owner}/{repo}/optimization-jobs
List all prompt optimization jobs.';
    protected const PARAMETERS = array (
  'repo' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `repo`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/repos/{owner}/{repo}/optimization-jobs';
    protected const PATH_PARAMS = array (
  0 => 'repo',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

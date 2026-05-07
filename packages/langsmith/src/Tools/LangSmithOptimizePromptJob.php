<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Optimize Prompt Job.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/repos/optimize-job.
 */
class LangSmithOptimizePromptJob extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_optimize_prompt_job';
    protected const DESCRIPTION = 'Optimize Prompt Job

Official endpoint: POST /api/v1/repos/optimize-job
Optimize prompt';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/repos/optimize-job';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

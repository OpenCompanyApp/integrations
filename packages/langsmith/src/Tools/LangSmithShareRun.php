<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Share Run.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/runs/{run_id}/share.
 */
class LangSmithShareRun extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_share_run';
    protected const DESCRIPTION = 'Share Run

Official endpoint: PUT /api/v1/runs/{run_id}/share
Share a run.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/runs/{run_id}/share';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

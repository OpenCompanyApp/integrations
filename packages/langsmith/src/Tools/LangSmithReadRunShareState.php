<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Run Share State.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/runs/{run_id}/share.
 */
class LangSmithReadRunShareState extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_run_share_state';
    protected const DESCRIPTION = 'Read Run Share State

Official endpoint: GET /api/v1/runs/{run_id}/share
Get the state of sharing of a run.';
    protected const PARAMETERS = array (
  'run_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `run_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/runs/{run_id}/share';
    protected const PATH_PARAMS = array (
  0 => 'run_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

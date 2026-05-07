<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create thread run.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/threads/{threadID}/runs.
 */
class LangSmithPostV1FleetThreadsThreadidRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_threads_threadid_runs';
    protected const DESCRIPTION = 'Create thread run

Official endpoint: POST /v1/fleet/threads/{threadID}/runs
Starts a run on the thread. The request body must include `assistant_id` (the assistant to execute). Include run inputs and options in the body as supported by this API.';
    protected const PARAMETERS = array (
  'threadID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `threadID`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/threads/{threadID}/runs';
    protected const PATH_PARAMS = array (
  0 => 'threadID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

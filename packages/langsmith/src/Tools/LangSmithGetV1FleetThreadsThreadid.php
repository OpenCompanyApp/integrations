<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get thread.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/threads/{threadID}.
 */
class LangSmithGetV1FleetThreadsThreadid extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_threads_threadid';
    protected const DESCRIPTION = 'Get thread

Official endpoint: GET /v1/fleet/threads/{threadID}
Returns thread metadata and status for the given thread id.';
    protected const PARAMETERS = array (
  'threadID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `threadID`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/threads/{threadID}';
    protected const PATH_PARAMS = array (
  0 => 'threadID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

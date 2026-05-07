<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Resolve an interrupted thread.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/threads/{threadID}/resolve-interrupt.
 */
class LangSmithPostV1FleetThreadsThreadidResolveInterrupt extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_threads_threadid_resolve_interrupt';
    protected const DESCRIPTION = 'Resolve an interrupted thread

Official endpoint: POST /v1/fleet/threads/{threadID}/resolve-interrupt
Completes a human-interrupt pause on the thread without sending new input, allowing execution to continue or finish. On success the response has no body.';
    protected const PARAMETERS = array (
  'threadID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `threadID`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/threads/{threadID}/resolve-interrupt';
    protected const PATH_PARAMS = array (
  0 => 'threadID',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create thread.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/threads.
 */
class LangSmithPostV1FleetThreads extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_threads';
    protected const DESCRIPTION = 'Create thread

Official endpoint: POST /v1/fleet/threads
Creates a thread record for use with subsequent runs. Request and response bodies are JSON objects describing the thread.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/threads';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

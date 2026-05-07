<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a tool by handle.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/tools/{handle}.
 */
class LangSmithGetV1PlatformToolsHandle extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_tools_handle';
    protected const DESCRIPTION = 'Get a tool by handle

Official endpoint: GET /v1/platform/tools/{handle}
Returns a tool identified by its handle.';
    protected const PARAMETERS = array (
  'handle' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `handle`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/tools/{handle}';
    protected const PATH_PARAMS = array (
  0 => 'handle',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

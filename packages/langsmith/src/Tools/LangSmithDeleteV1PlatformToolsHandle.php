<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a tool by handle.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/tools/{handle}.
 */
class LangSmithDeleteV1PlatformToolsHandle extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_tools_handle';
    protected const DESCRIPTION = 'Delete a tool by handle

Official endpoint: DELETE /v1/platform/tools/{handle}
Deletes a tool identified by its handle.';
    protected const PARAMETERS = array (
  'handle' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `handle`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/tools/{handle}';
    protected const PATH_PARAMS = array (
  0 => 'handle',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

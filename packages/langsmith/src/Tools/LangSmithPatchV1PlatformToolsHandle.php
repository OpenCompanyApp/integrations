<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update a tool by handle.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/platform/tools/{handle}.
 */
class LangSmithPatchV1PlatformToolsHandle extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_platform_tools_handle';
    protected const DESCRIPTION = 'Update a tool by handle

Official endpoint: PATCH /v1/platform/tools/{handle}
Updates an existing tool identified by its handle.';
    protected const PARAMETERS = array (
  'handle' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `handle`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/platform/tools/{handle}';
    protected const PATH_PARAMS = array (
  0 => 'handle',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

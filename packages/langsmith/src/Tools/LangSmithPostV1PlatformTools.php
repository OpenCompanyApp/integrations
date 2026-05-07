<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a tool.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/tools.
 */
class LangSmithPostV1PlatformTools extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_tools';
    protected const DESCRIPTION = 'Create a tool

Official endpoint: POST /v1/platform/tools
Creates a new tool in the workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/tools';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Tool Def Json Schema.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/schemas/{version}/tooldef.json.
 */
class LangSmithGetToolDefJsonSchema extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_tool_def_json_schema';
    protected const DESCRIPTION = 'Get Tool Def Json Schema

Official endpoint: GET /api/v1/public/schemas/{version}/tooldef.json
Get Tool Def Json Schema.';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/schemas/{version}/tooldef.json';
    protected const PATH_PARAMS = array (
  0 => 'version',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

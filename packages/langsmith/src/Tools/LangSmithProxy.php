<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Proxy.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/mcp/proxy.
 */
class LangSmithProxy extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_proxy';
    protected const DESCRIPTION = 'Proxy

Official endpoint: POST /api/v1/mcp/proxy
Proxy.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/mcp/proxy';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List integrations.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/integrations.
 */
class LangSmithGetV1FleetIntegrations extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_integrations';
    protected const DESCRIPTION = 'List integrations

Official endpoint: GET /v1/fleet/integrations
Returns integrations available to the workspace.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: source, page_size, cursor.',
  ),
  'source' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `source`.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `page_size`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `cursor`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/integrations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'source',
  1 => 'page_size',
  2 => 'cursor',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

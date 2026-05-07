<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get an integration.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/integrations/{id}.
 */
class LangSmithGetV1FleetIntegrationsId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_integrations_id';
    protected const DESCRIPTION = 'Get an integration

Official endpoint: GET /v1/fleet/integrations/{id}
Get an integration.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/integrations/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a custom integration.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/integrations.
 */
class LangSmithPostV1FleetIntegrations extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_integrations';
    protected const DESCRIPTION = 'Create a custom integration

Official endpoint: POST /v1/fleet/integrations
Registers a new custom integration. Type is forced to CUSTOM.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/integrations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

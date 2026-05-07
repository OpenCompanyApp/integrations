<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get an OAuth provider.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/auth-providers/{provider_id}.
 */
class LangSmithGetV1FleetAuthProvidersProviderId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_auth_providers_provider_id';
    protected const DESCRIPTION = 'Get an OAuth provider

Official endpoint: GET /v1/fleet/auth-providers/{provider_id}
Returns a single OAuth provider by ID.';
    protected const PARAMETERS = array (
  'provider_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `provider_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/auth-providers/{provider_id}';
    protected const PATH_PARAMS = array (
  0 => 'provider_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

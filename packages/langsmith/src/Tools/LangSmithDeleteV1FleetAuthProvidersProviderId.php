<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete an OAuth provider.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/fleet/auth-providers/{provider_id}.
 */
class LangSmithDeleteV1FleetAuthProvidersProviderId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_fleet_auth_providers_provider_id';
    protected const DESCRIPTION = 'Delete an OAuth provider

Official endpoint: DELETE /v1/fleet/auth-providers/{provider_id}
Deletes an OAuth provider. Tokens previously issued for this provider are revoked.';
    protected const PARAMETERS = array (
  'provider_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `provider_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/fleet/auth-providers/{provider_id}';
    protected const PATH_PARAMS = array (
  0 => 'provider_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

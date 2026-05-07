<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update an OAuth provider.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/fleet/auth-providers/{provider_id}.
 */
class LangSmithPatchV1FleetAuthProvidersProviderId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_fleet_auth_providers_provider_id';
    protected const DESCRIPTION = 'Update an OAuth provider

Official endpoint: PATCH /v1/fleet/auth-providers/{provider_id}
Updates an OAuth provider\'s configuration. Sent fields replace the stored values; absent fields are left unchanged.';
    protected const PARAMETERS = array (
  'provider_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `provider_id`.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/fleet/auth-providers/{provider_id}';
    protected const PATH_PARAMS = array (
  0 => 'provider_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get the authenticated user's provider user ID.
 *
 * Maps to the official LangSmith endpoint GET /me/providers/{providerType}.
 */
class LangSmithGetMeProvidersProvidertype extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_me_providers_providertype';
    protected const DESCRIPTION = 'Get the authenticated user\'s provider user ID

Official endpoint: GET /me/providers/{providerType}
Returns the provider user ID associated with the authenticated user for a given provider type, or null if not set. Scoped to the current tenant.';
    protected const PARAMETERS = array (
  'providerType' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `providerType`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/me/providers/{providerType}';
    protected const PATH_PARAMS = array (
  0 => 'providerType',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

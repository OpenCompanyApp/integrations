<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Register an OAuth provider.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/auth-providers.
 */
class LangSmithPostV1FleetAuthProviders extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_auth_providers';
    protected const DESCRIPTION = 'Register an OAuth provider

Official endpoint: POST /v1/fleet/auth-providers
Registers an OAuth provider configuration for your organization. End users can then start authorization sessions against this provider.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/auth-providers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

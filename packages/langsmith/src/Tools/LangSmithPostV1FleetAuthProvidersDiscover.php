<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Discover and register an OAuth provider.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/auth-providers/discover.
 */
class LangSmithPostV1FleetAuthProvidersDiscover extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_auth_providers_discover';
    protected const DESCRIPTION = 'Discover and register an OAuth provider

Official endpoint: POST /v1/fleet/auth-providers/discover
Auto-discovers an OAuth provider\'s metadata from an MCP server URL and registers it for your organization in one step.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/auth-providers/discover';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

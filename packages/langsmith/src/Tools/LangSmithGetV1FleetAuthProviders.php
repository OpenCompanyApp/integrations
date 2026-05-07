<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List OAuth providers.
 *
 * Maps to the official LangSmith endpoint GET /v1/fleet/auth-providers.
 */
class LangSmithGetV1FleetAuthProviders extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_fleet_auth_providers';
    protected const DESCRIPTION = 'List OAuth providers

Official endpoint: GET /v1/fleet/auth-providers
Lists the OAuth providers configured for your organization. Each provider defines how a third-party service (GitHub, Google, Slack, etc.) authorizes connections.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/fleet/auth-providers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

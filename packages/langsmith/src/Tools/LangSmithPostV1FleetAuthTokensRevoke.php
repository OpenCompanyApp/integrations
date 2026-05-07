<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Revoke connection tokens by filter.
 *
 * Maps to the official LangSmith endpoint POST /v1/fleet/auth-tokens/revoke.
 */
class LangSmithPostV1FleetAuthTokensRevoke extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_fleet_auth_tokens_revoke';
    protected const DESCRIPTION = 'Revoke connection tokens by filter

Official endpoint: POST /v1/fleet/auth-tokens/revoke
Revokes the caller\'s connection tokens matching the body filter. Requires at least provider_id; rejects empty filters to prevent accidental mass revocation.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fleet/auth-tokens/revoke';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

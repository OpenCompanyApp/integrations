<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Revoke a connection token.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/fleet/auth-tokens/{token_id}.
 */
class LangSmithDeleteV1FleetAuthTokensTokenId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_fleet_auth_tokens_token_id';
    protected const DESCRIPTION = 'Revoke a connection token

Official endpoint: DELETE /v1/fleet/auth-tokens/{token_id}
Revokes a single connection token by ID. The user is disconnected from the corresponding service.';
    protected const PARAMETERS = array (
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `token_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/fleet/auth-tokens/{token_id}';
    protected const PATH_PARAMS = array (
  0 => 'token_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

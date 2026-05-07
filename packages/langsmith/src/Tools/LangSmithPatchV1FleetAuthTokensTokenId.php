<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update a connection token.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/fleet/auth-tokens/{token_id}.
 */
class LangSmithPatchV1FleetAuthTokensTokenId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_fleet_auth_tokens_token_id';
    protected const DESCRIPTION = 'Update a connection token

Official endpoint: PATCH /v1/fleet/auth-tokens/{token_id}
Updates a token\'s metadata such as label or default flag.';
    protected const PARAMETERS = array (
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `token_id`.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/fleet/auth-tokens/{token_id}';
    protected const PATH_PARAMS = array (
  0 => 'token_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

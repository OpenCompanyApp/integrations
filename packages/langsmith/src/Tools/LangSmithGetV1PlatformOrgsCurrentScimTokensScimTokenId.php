<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get a SCIM token.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/orgs/current/scim/tokens/{scim_token_id}.
 */
class LangSmithGetV1PlatformOrgsCurrentScimTokensScimTokenId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_orgs_current_scim_tokens_scim_token_id';
    protected const DESCRIPTION = 'Get a SCIM token

Official endpoint: GET /v1/platform/orgs/current/scim/tokens/{scim_token_id}
Retrieve a specific SCIM token by ID for the current organization. The full token value is not returned.';
    protected const PARAMETERS = array (
  'scim_token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scim_token_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/orgs/current/scim/tokens/{scim_token_id}';
    protected const PATH_PARAMS = array (
  0 => 'scim_token_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

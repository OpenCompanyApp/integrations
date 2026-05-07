<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update a SCIM token.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/platform/orgs/current/scim/tokens/{scim_token_id}.
 */
class LangSmithPatchV1PlatformOrgsCurrentScimTokensScimTokenId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_platform_orgs_current_scim_tokens_scim_token_id';
    protected const DESCRIPTION = 'Update a SCIM token

Official endpoint: PATCH /v1/platform/orgs/current/scim/tokens/{scim_token_id}
Update the description of an existing SCIM token for the current organization.';
    protected const PARAMETERS = array (
  'scim_token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scim_token_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/platform/orgs/current/scim/tokens/{scim_token_id}';
    protected const PATH_PARAMS = array (
  0 => 'scim_token_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

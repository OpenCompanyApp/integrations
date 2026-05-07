<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a SCIM token.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/orgs/current/scim/tokens/{scim_token_id}.
 */
class LangSmithDeleteV1PlatformOrgsCurrentScimTokensScimTokenId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_orgs_current_scim_tokens_scim_token_id';
    protected const DESCRIPTION = 'Delete a SCIM token

Official endpoint: DELETE /v1/platform/orgs/current/scim/tokens/{scim_token_id}
Delete a SCIM bearer token from the current organization.';
    protected const PARAMETERS = array (
  'scim_token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scim_token_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/orgs/current/scim/tokens/{scim_token_id}';
    protected const PATH_PARAMS = array (
  0 => 'scim_token_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create a SCIM token.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/orgs/current/scim/tokens.
 */
class LangSmithPostV1PlatformOrgsCurrentScimTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_orgs_current_scim_tokens';
    protected const DESCRIPTION = 'Create a SCIM token

Official endpoint: POST /v1/platform/orgs/current/scim/tokens
Create a new SCIM bearer token for the current organization. The full token value is only returned once upon creation.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/orgs/current/scim/tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

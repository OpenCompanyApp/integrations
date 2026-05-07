<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreatePersonalToken.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/user/tokens.
 */
class PulumiUsersCreatePersonalToken extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_create_personal_token';
    protected const DESCRIPTION = 'CreatePersonalToken

Official Pulumi Cloud endpoint: POST /api/user/tokens

Creates a new personal access token for the authenticated user. The request body includes a description for the token and an optional expiration time. The response includes the token ID and the tokenValue (prefixed with \'pul-\'). The token value is only returned once at creation time and cannot be retrieved later.';
    protected const PARAMETERS = array (
  'reason' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reason` from the official Pulumi Cloud API operation. Tracks the context that triggered token creation (e.g., redirect URL or referral source)',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/user/tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'reason' => 'reason',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

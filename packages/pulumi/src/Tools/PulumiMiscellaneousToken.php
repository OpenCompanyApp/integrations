<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * Token.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/oauth/token.
 */
class PulumiMiscellaneousToken extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_miscellaneous_token';
    protected const DESCRIPTION = 'Token

Official Pulumi Cloud endpoint: POST /api/oauth/token

Exchanges an external identity provider token for a Pulumi access token using the OAuth 2.0 Token Exchange flow (RFC 8693). The request body must include: - `audience`: a URN identifying the target org (e.g., `urn:pulumi:org:{ORG_NAME}`) - `grant_type`: must be `urn:ietf:params:oauth:grant-type:token-exchange` - `subject_token`: the OIDC identity token from the external provider - `subject_token_type`: must be `urn:ietf:params:oauth:token-type:id_token` - `requested_token_type`: one of `urn:pulumi:token-type:access_token:organization`, `...team`, `...personal`, or `...runner` Optional parameters: - `scope`: depends on the requested token type. For `organization`, must be empty or `admin`. For `team`, must be `team:TEAM_NAME`. For `personal`, must be `user:USER_LOGIN`. For `runner`, must be `runner:RUNNER_NAME`. - `expiration`: token lifetime in seconds The response includes `access_to...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/oauth/token';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

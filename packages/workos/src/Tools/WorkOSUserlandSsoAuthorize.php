<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an authorization URL.
 *
 * Maps to the official WorkOS endpoint get /user_management/authorize.
 */
class WorkOSUserlandSsoAuthorize extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_sso_authorize';
    protected const DESCRIPTION = 'Get an authorization URL

Official WorkOS endpoint: GET /user_management/authorize

Generates an OAuth 2.0 authorization URL to authenticate a user with AuthKit or SSO.';
    protected const PARAMETERS = array (
  'code_challenge_method' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `code_challenge_method` from the official WorkOS API operation.',
  ),
  'code_challenge' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `code_challenge` from the official WorkOS API operation.',
  ),
  'domain_hint' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `domain_hint` from the official WorkOS API operation.',
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `connection_id` from the official WorkOS API operation.',
  ),
  'provider_query_params' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `provider_query_params` from the official WorkOS API operation.',
  ),
  'provider_scopes' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `provider_scopes` from the official WorkOS API operation.',
  ),
  'invitation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `invitation_token` from the official WorkOS API operation.',
  ),
  'screen_hint' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `screen_hint` from the official WorkOS API operation.',
    'enum' =>
    array (
      0 => 'sign-up',
      1 => 'sign-in',
    ),
  ),
  'login_hint' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `login_hint` from the official WorkOS API operation.',
  ),
  'provider' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `provider` from the official WorkOS API operation.',
    'enum' =>
    array (
      0 => 'authkit',
      1 => 'AppleOAuth',
      2 => 'BitbucketOAuth',
      3 => 'GitHubOAuth',
      4 => 'GitLabOAuth',
      5 => 'GoogleOAuth',
      6 => 'IntuitOAuth',
      7 => 'LinkedInOAuth',
      8 => 'MicrosoftOAuth',
      9 => 'SalesforceOAuth',
      10 => 'SlackOAuth',
      11 => 'VercelMarketplaceOAuth',
      12 => 'VercelOAuth',
      13 => 'XeroOAuth',
    ),
  ),
  'prompt' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `prompt` from the official WorkOS API operation.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `state` from the official WorkOS API operation.',
  ),
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
  'response_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `response_type` from the official WorkOS API operation.',
  ),
  'redirect_uri' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `redirect_uri` from the official WorkOS API operation.',
  ),
  'client_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `client_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/authorize';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'code_challenge_method' => 'code_challenge_method',
  'code_challenge' => 'code_challenge',
  'domain_hint' => 'domain_hint',
  'connection_id' => 'connection_id',
  'provider_query_params' => 'provider_query_params',
  'provider_scopes' => 'provider_scopes',
  'invitation_token' => 'invitation_token',
  'screen_hint' => 'screen_hint',
  'login_hint' => 'login_hint',
  'provider' => 'provider',
  'prompt' => 'prompt',
  'state' => 'state',
  'organization_id' => 'organization_id',
  'response_type' => 'response_type',
  'redirect_uri' => 'redirect_uri',
  'client_id' => 'client_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

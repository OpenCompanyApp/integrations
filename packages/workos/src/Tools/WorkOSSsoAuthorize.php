<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Initiate SSO.
 *
 * Maps to the official WorkOS endpoint get /sso/authorize.
 */
class WorkOSSsoAuthorize extends AbstractWorkOSTool
{
    protected const NAME = 'workos_sso_authorize';
    protected const DESCRIPTION = 'Initiate SSO

Official WorkOS endpoint: GET /sso/authorize

Initiates the single sign-on flow.';
    protected const PARAMETERS = array (
  'provider_scopes' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `provider_scopes` from the official WorkOS API operation.',
  ),
  'provider_query_params' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `provider_query_params` from the official WorkOS API operation.',
  ),
  'client_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `client_id` from the official WorkOS API operation.',
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `domain` from the official WorkOS API operation.',
  ),
  'provider' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `provider` from the official WorkOS API operation.',
    'enum' =>
    array (
      0 => 'AppleOAuth',
      1 => 'BitbucketOAuth',
      2 => 'GitHubOAuth',
      3 => 'GitLabOAuth',
      4 => 'GoogleOAuth',
      5 => 'IntuitOAuth',
      6 => 'LinkedInOAuth',
      7 => 'MicrosoftOAuth',
      8 => 'SalesforceOAuth',
      9 => 'SlackOAuth',
      10 => 'VercelMarketplaceOAuth',
      11 => 'VercelOAuth',
      12 => 'XeroOAuth',
    ),
  ),
  'redirect_uri' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `redirect_uri` from the official WorkOS API operation.',
  ),
  'response_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `response_type` from the official WorkOS API operation.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `state` from the official WorkOS API operation.',
  ),
  'connection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `connection` from the official WorkOS API operation.',
  ),
  'organization' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization` from the official WorkOS API operation.',
  ),
  'domain_hint' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `domain_hint` from the official WorkOS API operation.',
  ),
  'login_hint' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `login_hint` from the official WorkOS API operation.',
  ),
  'nonce' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `nonce` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/sso/authorize';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'provider_scopes' => 'provider_scopes',
  'provider_query_params' => 'provider_query_params',
  'client_id' => 'client_id',
  'domain' => 'domain',
  'provider' => 'provider',
  'redirect_uri' => 'redirect_uri',
  'response_type' => 'response_type',
  'state' => 'state',
  'connection' => 'connection',
  'organization' => 'organization',
  'domain_hint' => 'domain_hint',
  'login_hint' => 'login_hint',
  'nonce' => 'nonce',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

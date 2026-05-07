<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a Profile and Token.
 *
 * Maps to the official WorkOS endpoint post /sso/token.
 */
class WorkOSSsoToken extends AbstractWorkOSTool
{
    protected const NAME = 'workos_sso_token';
    protected const DESCRIPTION = 'Get a Profile and Token

Official WorkOS endpoint: POST /sso/token

Get an access token along with the user [Profile](/reference/sso/profile) using the code passed to your [Redirect URI](/reference/sso/get-authorization-url/redirect-uri).';
    protected const PARAMETERS = array (
  'client_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `client_id` from the official WorkOS API operation.',
  ),
  'client_secret' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `client_secret` from the official WorkOS API operation.',
  ),
  'code' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `code` from the official WorkOS API operation.',
  ),
  'grant_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `grant_type` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sso/token';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'client_id' => 'client_id',
  'client_secret' => 'client_secret',
  'code' => 'code',
  'grant_type' => 'grant_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

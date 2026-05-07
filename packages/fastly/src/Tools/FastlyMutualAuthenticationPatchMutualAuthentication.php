<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a Mutual Authentication
 *
 * Maps to Fastly generated client operation MutualAuthenticationApi::patchMutualAuthentication (PATCH /tls/mutual_authentications/{mutual_authentication_id}).
 */
class FastlyMutualAuthenticationPatchMutualAuthentication extends AbstractFastlyTool
{
    protected const NAME = 'fastly_mutual_authentication_patch_mutual_authentication';
    protected const DESCRIPTION = 'Update a Mutual Authentication

Official Fastly client operation: MutualAuthenticationApi::patchMutualAuthentication
Endpoint: PATCH /tls/mutual_authentications/{mutual_authentication_id}

Update a Mutual Authentication';
    protected const PARAMETERS = array (
  'mutual_authentication_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `mutual_authentication_id`.',
  ),
  'mutual_authentication' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `mutual_authentication`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_mutual_authentication_patch_mutual_authentication',
  'class' => 'FastlyMutualAuthenticationPatchMutualAuthentication',
  'api_class' => 'MutualAuthenticationApi',
  'method_name' => 'patchMutualAuthentication',
  'method' => 'PATCH',
  'path' => '/tls/mutual_authentications/{mutual_authentication_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a Mutual Authentication',
  'description' => 'Update a Mutual Authentication',
  'type' => 'write',
  'parameters' =>
  array (
    'mutual_authentication_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `mutual_authentication_id`.',
    ),
    'mutual_authentication' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `mutual_authentication`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
  ),
  'path_params' =>
  array (
    'mutual_authentication_id' => 'mutual_authentication_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => 'mutual_authentication',
  'body_required' => false,
);
}

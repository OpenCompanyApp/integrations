<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Mutual Authentication
 *
 * Maps to Fastly generated client operation MutualAuthenticationApi::getMutualAuthentication (GET /tls/mutual_authentications/{mutual_authentication_id}).
 */
class FastlyMutualAuthenticationGetMutualAuthentication extends AbstractFastlyTool
{
    protected const NAME = 'fastly_mutual_authentication_get_mutual_authentication';
    protected const DESCRIPTION = 'Get a Mutual Authentication

Official Fastly client operation: MutualAuthenticationApi::getMutualAuthentication
Endpoint: GET /tls/mutual_authentications/{mutual_authentication_id}

Get a Mutual Authentication';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
  'mutual_authentication_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `mutual_authentication_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_mutual_authentication_get_mutual_authentication',
  'class' => 'FastlyMutualAuthenticationGetMutualAuthentication',
  'api_class' => 'MutualAuthenticationApi',
  'method_name' => 'getMutualAuthentication',
  'method' => 'GET',
  'path' => '/tls/mutual_authentications/{mutual_authentication_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Mutual Authentication',
  'description' => 'Get a Mutual Authentication',
  'type' => 'read',
  'parameters' =>
  array (
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
    'mutual_authentication_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `mutual_authentication_id`.',
    ),
  ),
  'path_params' =>
  array (
    'mutual_authentication_id' => 'mutual_authentication_id',
  ),
  'query_params' =>
  array (
    'include' => 'include',
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

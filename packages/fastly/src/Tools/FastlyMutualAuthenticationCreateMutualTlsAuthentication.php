<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a Mutual Authentication
 *
 * Maps to Fastly generated client operation MutualAuthenticationApi::createMutualTlsAuthentication (POST /tls/mutual_authentications).
 */
class FastlyMutualAuthenticationCreateMutualTlsAuthentication extends AbstractFastlyTool
{
    protected const NAME = 'fastly_mutual_authentication_create_mutual_tls_authentication';
    protected const DESCRIPTION = 'Create a Mutual Authentication

Official Fastly client operation: MutualAuthenticationApi::createMutualTlsAuthentication
Endpoint: POST /tls/mutual_authentications

Create a Mutual Authentication';
    protected const PARAMETERS = array (
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
  'slug' => 'fastly_mutual_authentication_create_mutual_tls_authentication',
  'class' => 'FastlyMutualAuthenticationCreateMutualTlsAuthentication',
  'api_class' => 'MutualAuthenticationApi',
  'method_name' => 'createMutualTlsAuthentication',
  'method' => 'POST',
  'path' => '/tls/mutual_authentications',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a Mutual Authentication',
  'description' => 'Create a Mutual Authentication',
  'type' => 'write',
  'parameters' =>
  array (
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

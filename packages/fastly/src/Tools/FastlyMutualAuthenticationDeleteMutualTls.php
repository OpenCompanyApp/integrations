<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Mutual TLS
 *
 * Maps to Fastly generated client operation MutualAuthenticationApi::deleteMutualTls (DELETE /tls/mutual_authentications/{mutual_authentication_id}).
 */
class FastlyMutualAuthenticationDeleteMutualTls extends AbstractFastlyTool
{
    protected const NAME = 'fastly_mutual_authentication_delete_mutual_tls';
    protected const DESCRIPTION = 'Delete a Mutual TLS

Official Fastly client operation: MutualAuthenticationApi::deleteMutualTls
Endpoint: DELETE /tls/mutual_authentications/{mutual_authentication_id}

Delete a Mutual TLS';
    protected const PARAMETERS = array (
  'mutual_authentication_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `mutual_authentication_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_mutual_authentication_delete_mutual_tls',
  'class' => 'FastlyMutualAuthenticationDeleteMutualTls',
  'api_class' => 'MutualAuthenticationApi',
  'method_name' => 'deleteMutualTls',
  'method' => 'DELETE',
  'path' => '/tls/mutual_authentications/{mutual_authentication_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Mutual TLS',
  'description' => 'Delete a Mutual TLS',
  'type' => 'write',
  'parameters' =>
  array (
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

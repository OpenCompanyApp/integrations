<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Disable TLS on a domain
 *
 * Maps to Fastly generated client operation TlsActivationsApi::deleteTlsActivation (DELETE /tls/activations/{tls_activation_id}).
 */
class FastlyTlsActivationsDeleteTlsActivation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_activations_delete_tls_activation';
    protected const DESCRIPTION = 'Disable TLS on a domain

Official Fastly client operation: TlsActivationsApi::deleteTlsActivation
Endpoint: DELETE /tls/activations/{tls_activation_id}

Disable TLS on a domain';
    protected const PARAMETERS = array (
  'tls_activation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_activation_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_activations_delete_tls_activation',
  'class' => 'FastlyTlsActivationsDeleteTlsActivation',
  'api_class' => 'TlsActivationsApi',
  'method_name' => 'deleteTlsActivation',
  'method' => 'DELETE',
  'path' => '/tls/activations/{tls_activation_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Disable TLS on a domain',
  'description' => 'Disable TLS on a domain',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_activation_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_activation_id`.',
    ),
  ),
  'path_params' =>
  array (
    'tls_activation_id' => 'tls_activation_id',
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

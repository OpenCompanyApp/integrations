<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a TLS activation
 *
 * Maps to Fastly generated client operation TlsActivationsApi::getTlsActivation (GET /tls/activations/{tls_activation_id}).
 */
class FastlyTlsActivationsGetTlsActivation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_activations_get_tls_activation';
    protected const DESCRIPTION = 'Get a TLS activation

Official Fastly client operation: TlsActivationsApi::getTlsActivation
Endpoint: GET /tls/activations/{tls_activation_id}

Get a TLS activation';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
  'tls_activation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_activation_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_activations_get_tls_activation',
  'class' => 'FastlyTlsActivationsGetTlsActivation',
  'api_class' => 'TlsActivationsApi',
  'method_name' => 'getTlsActivation',
  'method' => 'GET',
  'path' => '/tls/activations/{tls_activation_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a TLS activation',
  'description' => 'Get a TLS activation',
  'type' => 'read',
  'parameters' =>
  array (
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
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

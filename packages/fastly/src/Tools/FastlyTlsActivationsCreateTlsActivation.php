<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable TLS for a domain using a custom certificate
 *
 * Maps to Fastly generated client operation TlsActivationsApi::createTlsActivation (POST /tls/activations).
 */
class FastlyTlsActivationsCreateTlsActivation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_activations_create_tls_activation';
    protected const DESCRIPTION = 'Enable TLS for a domain using a custom certificate

Official Fastly client operation: TlsActivationsApi::createTlsActivation
Endpoint: POST /tls/activations

Enable TLS for a domain using a custom certificate';
    protected const PARAMETERS = array (
  'tls_activation' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tls_activation`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_activations_create_tls_activation',
  'class' => 'FastlyTlsActivationsCreateTlsActivation',
  'api_class' => 'TlsActivationsApi',
  'method_name' => 'createTlsActivation',
  'method' => 'POST',
  'path' => '/tls/activations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Enable TLS for a domain using a custom certificate',
  'description' => 'Enable TLS for a domain using a custom certificate',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_activation' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tls_activation`.',
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
  'body_param' => 'tls_activation',
  'body_required' => false,
);
}

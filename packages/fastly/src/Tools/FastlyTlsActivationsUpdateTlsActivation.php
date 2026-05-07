<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a certificate
 *
 * Maps to Fastly generated client operation TlsActivationsApi::updateTlsActivation (PATCH /tls/activations/{tls_activation_id}).
 */
class FastlyTlsActivationsUpdateTlsActivation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_activations_update_tls_activation';
    protected const DESCRIPTION = 'Update a certificate

Official Fastly client operation: TlsActivationsApi::updateTlsActivation
Endpoint: PATCH /tls/activations/{tls_activation_id}

Update a certificate';
    protected const PARAMETERS = array (
  'tls_activation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_activation_id`.',
  ),
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
  'slug' => 'fastly_tls_activations_update_tls_activation',
  'class' => 'FastlyTlsActivationsUpdateTlsActivation',
  'api_class' => 'TlsActivationsApi',
  'method_name' => 'updateTlsActivation',
  'method' => 'PATCH',
  'path' => '/tls/activations/{tls_activation_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a certificate',
  'description' => 'Update a certificate',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_activation_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_activation_id`.',
    ),
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
  'body_param' => 'tls_activation',
  'body_required' => false,
);
}

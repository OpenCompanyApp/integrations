<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a TLS configuration
 *
 * Maps to Fastly generated client operation TlsConfigurationsApi::updateTlsConfig (PATCH /tls/configurations/{tls_configuration_id}).
 */
class FastlyTlsConfigurationsUpdateTlsConfig extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_configurations_update_tls_config';
    protected const DESCRIPTION = 'Update a TLS configuration

Official Fastly client operation: TlsConfigurationsApi::updateTlsConfig
Endpoint: PATCH /tls/configurations/{tls_configuration_id}

Update a TLS configuration';
    protected const PARAMETERS = array (
  'tls_configuration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_configuration_id`.',
  ),
  'tls_configuration' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tls_configuration`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_configurations_update_tls_config',
  'class' => 'FastlyTlsConfigurationsUpdateTlsConfig',
  'api_class' => 'TlsConfigurationsApi',
  'method_name' => 'updateTlsConfig',
  'method' => 'PATCH',
  'path' => '/tls/configurations/{tls_configuration_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a TLS configuration',
  'description' => 'Update a TLS configuration',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_configuration_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_configuration_id`.',
    ),
    'tls_configuration' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tls_configuration`.',
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
    'tls_configuration_id' => 'tls_configuration_id',
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
  'body_param' => 'tls_configuration',
  'body_required' => false,
);
}

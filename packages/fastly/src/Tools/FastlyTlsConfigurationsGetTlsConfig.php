<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a TLS configuration
 *
 * Maps to Fastly generated client operation TlsConfigurationsApi::getTlsConfig (GET /tls/configurations/{tls_configuration_id}).
 */
class FastlyTlsConfigurationsGetTlsConfig extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_configurations_get_tls_config';
    protected const DESCRIPTION = 'Get a TLS configuration

Official Fastly client operation: TlsConfigurationsApi::getTlsConfig
Endpoint: GET /tls/configurations/{tls_configuration_id}

Get a TLS configuration';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
  'tls_configuration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_configuration_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_configurations_get_tls_config',
  'class' => 'FastlyTlsConfigurationsGetTlsConfig',
  'api_class' => 'TlsConfigurationsApi',
  'method_name' => 'getTlsConfig',
  'method' => 'GET',
  'path' => '/tls/configurations/{tls_configuration_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a TLS configuration',
  'description' => 'Get a TLS configuration',
  'type' => 'read',
  'parameters' =>
  array (
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
    'tls_configuration_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_configuration_id`.',
    ),
  ),
  'path_params' =>
  array (
    'tls_configuration_id' => 'tls_configuration_id',
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

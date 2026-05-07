<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List TLS configurations
 *
 * Maps to Fastly generated client operation TlsConfigurationsApi::listTlsConfigs (GET /tls/configurations).
 */
class FastlyTlsConfigurationsListTlsConfigs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_configurations_list_tls_configs';
    protected const DESCRIPTION = 'List TLS configurations

Official Fastly client operation: TlsConfigurationsApi::listTlsConfigs
Endpoint: GET /tls/configurations

List TLS configurations';
    protected const PARAMETERS = array (
  'filter_bulk' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_bulk`.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
  'page_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_number`.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_size`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_configurations_list_tls_configs',
  'class' => 'FastlyTlsConfigurationsListTlsConfigs',
  'api_class' => 'TlsConfigurationsApi',
  'method_name' => 'listTlsConfigs',
  'method' => 'GET',
  'path' => '/tls/configurations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List TLS configurations',
  'description' => 'List TLS configurations',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_bulk' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_bulk`.',
    ),
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
    'page_number' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_number`.',
    ),
    'page_size' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_size`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'filter[bulk]' => 'filter_bulk',
    'include' => 'include',
    'page[number]' => 'page_number',
    'page[size]' => 'page_size',
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

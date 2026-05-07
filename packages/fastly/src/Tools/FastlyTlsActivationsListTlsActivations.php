<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List TLS activations
 *
 * Maps to Fastly generated client operation TlsActivationsApi::listTlsActivations (GET /tls/activations).
 */
class FastlyTlsActivationsListTlsActivations extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_activations_list_tls_activations';
    protected const DESCRIPTION = 'List TLS activations

Official Fastly client operation: TlsActivationsApi::listTlsActivations
Endpoint: GET /tls/activations

List TLS activations';
    protected const PARAMETERS = array (
  'filter_tls_certificate_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_certificate_id`.',
  ),
  'filter_tls_configuration_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_configuration_id`.',
  ),
  'filter_tls_domain_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_domain_id`.',
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
  'slug' => 'fastly_tls_activations_list_tls_activations',
  'class' => 'FastlyTlsActivationsListTlsActivations',
  'api_class' => 'TlsActivationsApi',
  'method_name' => 'listTlsActivations',
  'method' => 'GET',
  'path' => '/tls/activations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List TLS activations',
  'description' => 'List TLS activations',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_tls_certificate_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_certificate_id`.',
    ),
    'filter_tls_configuration_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_configuration_id`.',
    ),
    'filter_tls_domain_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_domain_id`.',
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
    'filter[tls_certificate.id]' => 'filter_tls_certificate_id',
    'filter[tls_configuration.id]' => 'filter_tls_configuration_id',
    'filter[tls_domain.id]' => 'filter_tls_domain_id',
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

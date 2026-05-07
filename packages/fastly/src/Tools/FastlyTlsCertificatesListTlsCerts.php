<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List TLS certificates
 *
 * Maps to Fastly generated client operation TlsCertificatesApi::listTlsCerts (GET /tls/certificates).
 */
class FastlyTlsCertificatesListTlsCerts extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_certificates_list_tls_certs';
    protected const DESCRIPTION = 'List TLS certificates

Official Fastly client operation: TlsCertificatesApi::listTlsCerts
Endpoint: GET /tls/certificates

List TLS certificates';
    protected const PARAMETERS = array (
  'filter_in_use' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_in_use`.',
  ),
  'filter_not_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_not_after`.',
  ),
  'filter_tls_domains_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_domains_id`.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
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
  'slug' => 'fastly_tls_certificates_list_tls_certs',
  'class' => 'FastlyTlsCertificatesListTlsCerts',
  'api_class' => 'TlsCertificatesApi',
  'method_name' => 'listTlsCerts',
  'method' => 'GET',
  'path' => '/tls/certificates',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List TLS certificates',
  'description' => 'List TLS certificates',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_in_use' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_in_use`.',
    ),
    'filter_not_after' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_not_after`.',
    ),
    'filter_tls_domains_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_domains_id`.',
    ),
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
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
    'filter[in_use]' => 'filter_in_use',
    'filter[not_after]' => 'filter_not_after',
    'filter[tls_domains.id]' => 'filter_tls_domains_id',
    'include' => 'include',
    'sort' => 'sort',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List certificates
 *
 * Maps to Fastly generated client operation TlsBulkCertificatesApi::listTlsBulkCerts (GET /tls/bulk/certificates).
 */
class FastlyTlsBulkCertificatesListTlsBulkCerts extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_bulk_certificates_list_tls_bulk_certs';
    protected const DESCRIPTION = 'List certificates

Official Fastly client operation: TlsBulkCertificatesApi::listTlsBulkCerts
Endpoint: GET /tls/bulk/certificates

List certificates';
    protected const PARAMETERS = array (
  'filter_tls_domain_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_domain_id`.',
  ),
  'filter_not_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_not_before`.',
  ),
  'filter_not_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_not_after`.',
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
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_bulk_certificates_list_tls_bulk_certs',
  'class' => 'FastlyTlsBulkCertificatesListTlsBulkCerts',
  'api_class' => 'TlsBulkCertificatesApi',
  'method_name' => 'listTlsBulkCerts',
  'method' => 'GET',
  'path' => '/tls/bulk/certificates',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List certificates',
  'description' => 'List certificates',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_tls_domain_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_domain_id`.',
    ),
    'filter_not_before' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_not_before`.',
    ),
    'filter_not_after' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_not_after`.',
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
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'filter[tls_domain.id]' => 'filter_tls_domain_id',
    'filter[not_before]' => 'filter_not_before',
    'filter[not_after]' => 'filter_not_after',
    'page[number]' => 'page_number',
    'page[size]' => 'page_size',
    'sort' => 'sort',
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

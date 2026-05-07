<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List TLS domains
 *
 * Maps to Fastly generated client operation TlsDomainsApi::listTlsDomains (GET /tls/domains).
 */
class FastlyTlsDomainsListTlsDomains extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_domains_list_tls_domains';
    protected const DESCRIPTION = 'List TLS domains

Official Fastly client operation: TlsDomainsApi::listTlsDomains
Endpoint: GET /tls/domains

List TLS domains';
    protected const PARAMETERS = array (
  'filter_in_use' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_in_use`.',
  ),
  'filter_tls_certificates_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_certificates_id`.',
  ),
  'filter_tls_subscriptions_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_subscriptions_id`.',
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
  'slug' => 'fastly_tls_domains_list_tls_domains',
  'class' => 'FastlyTlsDomainsListTlsDomains',
  'api_class' => 'TlsDomainsApi',
  'method_name' => 'listTlsDomains',
  'method' => 'GET',
  'path' => '/tls/domains',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List TLS domains',
  'description' => 'List TLS domains',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_in_use' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_in_use`.',
    ),
    'filter_tls_certificates_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_certificates_id`.',
    ),
    'filter_tls_subscriptions_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_subscriptions_id`.',
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
    'filter[tls_certificates.id]' => 'filter_tls_certificates_id',
    'filter[tls_subscriptions.id]' => 'filter_tls_subscriptions_id',
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

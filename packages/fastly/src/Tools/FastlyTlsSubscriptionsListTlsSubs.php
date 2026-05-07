<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List TLS subscriptions
 *
 * Maps to Fastly generated client operation TlsSubscriptionsApi::listTlsSubs (GET /tls/subscriptions).
 */
class FastlyTlsSubscriptionsListTlsSubs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_subscriptions_list_tls_subs';
    protected const DESCRIPTION = 'List TLS subscriptions

Official Fastly client operation: TlsSubscriptionsApi::listTlsSubs
Endpoint: GET /tls/subscriptions

List TLS subscriptions';
    protected const PARAMETERS = array (
  'filter_state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_state`.',
  ),
  'filter_tls_domains_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_tls_domains_id`.',
  ),
  'filter_has_active_order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_has_active_order`.',
  ),
  'filter_certificate_authority' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_certificate_authority`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
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
  'slug' => 'fastly_tls_subscriptions_list_tls_subs',
  'class' => 'FastlyTlsSubscriptionsListTlsSubs',
  'api_class' => 'TlsSubscriptionsApi',
  'method_name' => 'listTlsSubs',
  'method' => 'GET',
  'path' => '/tls/subscriptions',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List TLS subscriptions',
  'description' => 'List TLS subscriptions',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_state' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_state`.',
    ),
    'filter_tls_domains_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_tls_domains_id`.',
    ),
    'filter_has_active_order' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_has_active_order`.',
    ),
    'filter_certificate_authority' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_certificate_authority`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
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
    'filter[state]' => 'filter_state',
    'filter[tls_domains.id]' => 'filter_tls_domains_id',
    'filter[has_active_order]' => 'filter_has_active_order',
    'filter[certificate_authority]' => 'filter_certificate_authority',
    'sort' => 'sort',
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

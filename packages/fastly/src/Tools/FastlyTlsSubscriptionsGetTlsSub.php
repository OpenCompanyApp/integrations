<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a TLS subscription
 *
 * Maps to Fastly generated client operation TlsSubscriptionsApi::getTlsSub (GET /tls/subscriptions/{tls_subscription_id}).
 */
class FastlyTlsSubscriptionsGetTlsSub extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_subscriptions_get_tls_sub';
    protected const DESCRIPTION = 'Get a TLS subscription

Official Fastly client operation: TlsSubscriptionsApi::getTlsSub
Endpoint: GET /tls/subscriptions/{tls_subscription_id}

Get a TLS subscription';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
  'tls_subscription_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_subscription_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_subscriptions_get_tls_sub',
  'class' => 'FastlyTlsSubscriptionsGetTlsSub',
  'api_class' => 'TlsSubscriptionsApi',
  'method_name' => 'getTlsSub',
  'method' => 'GET',
  'path' => '/tls/subscriptions/{tls_subscription_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a TLS subscription',
  'description' => 'Get a TLS subscription',
  'type' => 'read',
  'parameters' =>
  array (
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
    'tls_subscription_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_subscription_id`.',
    ),
  ),
  'path_params' =>
  array (
    'tls_subscription_id' => 'tls_subscription_id',
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

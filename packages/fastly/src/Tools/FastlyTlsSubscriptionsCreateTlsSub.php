<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a TLS subscription
 *
 * Maps to Fastly generated client operation TlsSubscriptionsApi::createTlsSub (POST /tls/subscriptions).
 */
class FastlyTlsSubscriptionsCreateTlsSub extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_subscriptions_create_tls_sub';
    protected const DESCRIPTION = 'Create a TLS subscription

Official Fastly client operation: TlsSubscriptionsApi::createTlsSub
Endpoint: POST /tls/subscriptions

Create a TLS subscription';
    protected const PARAMETERS = array (
  'tls_subscription' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tls_subscription`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_subscriptions_create_tls_sub',
  'class' => 'FastlyTlsSubscriptionsCreateTlsSub',
  'api_class' => 'TlsSubscriptionsApi',
  'method_name' => 'createTlsSub',
  'method' => 'POST',
  'path' => '/tls/subscriptions',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a TLS subscription',
  'description' => 'Create a TLS subscription',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_subscription' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tls_subscription`.',
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
  'body_param' => 'tls_subscription',
  'body_required' => false,
);
}

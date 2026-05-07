<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a TLS subscription
 *
 * Maps to Fastly generated client operation TlsSubscriptionsApi::patchTlsSub (PATCH /tls/subscriptions/{tls_subscription_id}).
 */
class FastlyTlsSubscriptionsPatchTlsSub extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_subscriptions_patch_tls_sub';
    protected const DESCRIPTION = 'Update a TLS subscription

Official Fastly client operation: TlsSubscriptionsApi::patchTlsSub
Endpoint: PATCH /tls/subscriptions/{tls_subscription_id}

Update a TLS subscription';
    protected const PARAMETERS = array (
  'tls_subscription_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_subscription_id`.',
  ),
  'force' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `force`.',
  ),
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
  'slug' => 'fastly_tls_subscriptions_patch_tls_sub',
  'class' => 'FastlyTlsSubscriptionsPatchTlsSub',
  'api_class' => 'TlsSubscriptionsApi',
  'method_name' => 'patchTlsSub',
  'method' => 'PATCH',
  'path' => '/tls/subscriptions/{tls_subscription_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a TLS subscription',
  'description' => 'Update a TLS subscription',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_subscription_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_subscription_id`.',
    ),
    'force' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `force`.',
    ),
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
    'tls_subscription_id' => 'tls_subscription_id',
  ),
  'query_params' =>
  array (
    'force' => 'force',
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

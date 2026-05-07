<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a TLS subscription
 *
 * Maps to Fastly generated client operation TlsSubscriptionsApi::deleteTlsSub (DELETE /tls/subscriptions/{tls_subscription_id}).
 */
class FastlyTlsSubscriptionsDeleteTlsSub extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_subscriptions_delete_tls_sub';
    protected const DESCRIPTION = 'Delete a TLS subscription

Official Fastly client operation: TlsSubscriptionsApi::deleteTlsSub
Endpoint: DELETE /tls/subscriptions/{tls_subscription_id}

Delete a TLS subscription';
    protected const PARAMETERS = array (
  'tls_subscription_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_subscription_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_subscriptions_delete_tls_sub',
  'class' => 'FastlyTlsSubscriptionsDeleteTlsSub',
  'api_class' => 'TlsSubscriptionsApi',
  'method_name' => 'deleteTlsSub',
  'method' => 'DELETE',
  'path' => '/tls/subscriptions/{tls_subscription_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a TLS subscription',
  'description' => 'Delete a TLS subscription',
  'type' => 'write',
  'parameters' =>
  array (
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

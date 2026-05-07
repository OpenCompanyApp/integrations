<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Creates a GlobalSign email challenge.
 *
 * Maps to Fastly generated client operation TlsSubscriptionsApi::createGlobalsignEmailChallenge (POST /tls/subscriptions/{tls_subscription_id}/authorizations/{tls_authorization_id}/globalsign_email_challenges).
 */
class FastlyTlsSubscriptionsCreateGlobalsignEmailChallenge extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_subscriptions_create_globalsign_email_challenge';
    protected const DESCRIPTION = 'Creates a GlobalSign email challenge.

Official Fastly client operation: TlsSubscriptionsApi::createGlobalsignEmailChallenge
Endpoint: POST /tls/subscriptions/{tls_subscription_id}/authorizations/{tls_authorization_id}/globalsign_email_challenges

Creates a GlobalSign email challenge.';
    protected const PARAMETERS = array (
  'tls_subscription_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_subscription_id`.',
  ),
  'tls_authorization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_authorization_id`.',
  ),
  'request_body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_subscriptions_create_globalsign_email_challenge',
  'class' => 'FastlyTlsSubscriptionsCreateGlobalsignEmailChallenge',
  'api_class' => 'TlsSubscriptionsApi',
  'method_name' => 'createGlobalsignEmailChallenge',
  'method' => 'POST',
  'path' => '/tls/subscriptions/{tls_subscription_id}/authorizations/{tls_authorization_id}/globalsign_email_challenges',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Creates a GlobalSign email challenge.',
  'description' => 'Creates a GlobalSign email challenge.',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_subscription_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_subscription_id`.',
    ),
    'tls_authorization_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_authorization_id`.',
    ),
    'request_body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
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
    'tls_authorization_id' => 'tls_authorization_id',
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
  'body_param' => 'request_body',
  'body_required' => false,
);
}

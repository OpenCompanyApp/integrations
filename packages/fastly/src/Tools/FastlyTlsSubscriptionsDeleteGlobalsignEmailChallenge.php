<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a GlobalSign email challenge
 *
 * Maps to Fastly generated client operation TlsSubscriptionsApi::deleteGlobalsignEmailChallenge (DELETE /tls/subscriptions/{tls_subscription_id}/authorizations/{tls_authorization_id}/globalsign_email_challenges/{globalsign_email_challenge_id}).
 */
class FastlyTlsSubscriptionsDeleteGlobalsignEmailChallenge extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_subscriptions_delete_globalsign_email_challenge';
    protected const DESCRIPTION = 'Delete a GlobalSign email challenge

Official Fastly client operation: TlsSubscriptionsApi::deleteGlobalsignEmailChallenge
Endpoint: DELETE /tls/subscriptions/{tls_subscription_id}/authorizations/{tls_authorization_id}/globalsign_email_challenges/{globalsign_email_challenge_id}

Delete a GlobalSign email challenge';
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
  'globalsign_email_challenge_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `globalsign_email_challenge_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_subscriptions_delete_globalsign_email_challenge',
  'class' => 'FastlyTlsSubscriptionsDeleteGlobalsignEmailChallenge',
  'api_class' => 'TlsSubscriptionsApi',
  'method_name' => 'deleteGlobalsignEmailChallenge',
  'method' => 'DELETE',
  'path' => '/tls/subscriptions/{tls_subscription_id}/authorizations/{tls_authorization_id}/globalsign_email_challenges/{globalsign_email_challenge_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a GlobalSign email challenge',
  'description' => 'Delete a GlobalSign email challenge',
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
    'globalsign_email_challenge_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `globalsign_email_challenge_id`.',
    ),
  ),
  'path_params' =>
  array (
    'tls_subscription_id' => 'tls_subscription_id',
    'tls_authorization_id' => 'tls_authorization_id',
    'globalsign_email_challenge_id' => 'globalsign_email_challenge_id',
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

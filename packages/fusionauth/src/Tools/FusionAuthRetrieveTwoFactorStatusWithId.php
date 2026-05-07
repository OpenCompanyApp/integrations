<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Two Factor Status With Id.
 *
 * Maps to GET /api/two-factor/status/{twoFactorTrustId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveTwoFactorStatusWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_two_factor_status_with_id',
  'class' => 'FusionAuthRetrieveTwoFactorStatusWithId',
  'method' => 'GET',
  'path' => '/api/two-factor/status/{twoFactorTrustId}',
  'operation_id' => 'retrieveTwoFactorStatusWithId',
  'summary' => 'retrieve Two Factor Status With Id',
  'description' => 'Retrieve a user\'s two-factor status. This can be used to see if a user will need to complete a two-factor challenge to complete a login, and optionally identify the state of the two-factor trust across various applications.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The user Id to retrieve the Two-Factor status.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The optional applicationId to verify.',
    ),
    'two_factor_trust_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The optional two-factor trust Id to verify.',
    ),
  ),
  'path_params' =>
  array (
    'twoFactorTrustId' => 'two_factor_trust_id',
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
    'applicationId' => 'application_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}

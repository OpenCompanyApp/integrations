<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Two Factor Status With Request With Id.
 *
 * Maps to POST /api/two-factor/status in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveTwoFactorStatusWithRequestWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_two_factor_status_with_request_with_id',
  'class' => 'FusionAuthRetrieveTwoFactorStatusWithRequestWithId',
  'method' => 'POST',
  'path' => '/api/two-factor/status',
  'operation_id' => 'retrieveTwoFactorStatusWithRequestWithId',
  'summary' => 'retrieve Two Factor Status With Request With Id',
  'description' => 'Retrieve a user\'s two-factor status. This can be used to see if a user will need to complete a two-factor challenge to complete a login, and optionally identify the state of the two-factor trust across various applications. This operation provides more payload options than retrieveTwoFactorStatus.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

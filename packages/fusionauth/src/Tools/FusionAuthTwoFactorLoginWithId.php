<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * two Factor Login With Id.
 *
 * Maps to POST /api/two-factor/login in the official FusionAuth OpenAPI document.
 */
class FusionAuthTwoFactorLoginWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_two_factor_login_with_id',
  'class' => 'FusionAuthTwoFactorLoginWithId',
  'method' => 'POST',
  'path' => '/api/two-factor/login',
  'operation_id' => 'twoFactorLoginWithId',
  'summary' => 'two Factor Login With Id',
  'description' => 'Complete login using a 2FA challenge',
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

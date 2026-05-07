<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete User Two Factor With Id.
 *
 * Maps to DELETE /api/user/two-factor/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteUserTwoFactorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_user_two_factor_with_id',
  'class' => 'FusionAuthDeleteUserTwoFactorWithId',
  'method' => 'DELETE',
  'path' => '/api/user/two-factor/{userId}',
  'operation_id' => 'deleteUserTwoFactorWithId',
  'summary' => 'delete User Two Factor With Id',
  'description' => 'Disable two-factor authentication for a user using a JSON body rather than URL parameters. OR Disable two-factor authentication for a user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the User for which you\'re disabling two-factor authentication.',
    ),
    'method_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The two-factor method identifier you wish to disable',
    ),
    'code' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The two-factor code used verify the the caller knows the two-factor secret.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
  ),
  'query_params' =>
  array (
    'methodId' => 'method_id',
    'code' => 'code',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

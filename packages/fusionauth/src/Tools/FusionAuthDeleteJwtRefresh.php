<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Jwt Refresh.
 *
 * Maps to DELETE /api/jwt/refresh in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteJwtRefresh extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_jwt_refresh',
  'class' => 'FusionAuthDeleteJwtRefresh',
  'method' => 'DELETE',
  'path' => '/api/jwt/refresh',
  'operation_id' => 'deleteJwtRefresh',
  'summary' => 'delete Jwt Refresh',
  'description' => 'Revokes refresh tokens using the information in the JSON body. The handling for this method is the same as the revokeRefreshToken method and is based on the information you provide in the RefreshDeleteRequest object. See that method for additional information. OR Revoke all refresh tokens that belong to a user by user Id for a specific application by applicationId. OR Revoke all refresh tokens that belong to a user by user Id. OR Revoke all refresh tokens that belong to an application by applica',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the user that you want to delete all refresh tokens for.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the application that you want to delete refresh tokens for.',
    ),
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The refresh token to delete.',
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
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
    'applicationId' => 'application_id',
    'token' => 'token',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

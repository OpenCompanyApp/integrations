<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * revoke Refresh Token By Id With Id.
 *
 * Maps to DELETE /api/jwt/refresh/{tokenId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRevokeRefreshTokenByIdWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_revoke_refresh_token_by_id_with_id',
  'class' => 'FusionAuthRevokeRefreshTokenByIdWithId',
  'method' => 'DELETE',
  'path' => '/api/jwt/refresh/{tokenId}',
  'operation_id' => 'revokeRefreshTokenByIdWithId',
  'summary' => 'revoke Refresh Token By Id With Id',
  'description' => 'Revokes a single refresh token by the unique Id. The unique Id is not sensitive as it cannot be used to obtain another JWT.',
  'parameters' =>
  array (
    'token_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique Id of the token to delete.',
    ),
  ),
  'path_params' =>
  array (
    'tokenId' => 'token_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}

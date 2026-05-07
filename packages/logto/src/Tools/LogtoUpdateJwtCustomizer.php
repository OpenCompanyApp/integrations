<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update JWT customizer.
 *
 * Maps to PATCH /api/configs/jwt-customizer/{tokenTypePath} in the official Logto OpenAPI source.
 */
class LogtoUpdateJwtCustomizer extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_jwt_customizer',
  'class' => 'LogtoUpdateJwtCustomizer',
  'method' => 'PATCH',
  'path' => '/api/configs/jwt-customizer/{tokenTypePath}',
  'operation_id' => 'UpdateJwtCustomizer',
  'summary' => 'Update JWT customizer',
  'description' => 'Update the JWT customizer for the given token type.',
  'parameters' =>
  array (
    'token_type_path' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The token type to update a JWT customizer for.',
      'enum' =>
      array (
        0 => 'access-token',
        1 => 'client-credentials',
      ),
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'tokenTypePath' => 'token_type_path',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

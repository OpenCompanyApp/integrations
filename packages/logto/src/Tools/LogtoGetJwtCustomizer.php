<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get JWT customizer.
 *
 * Maps to GET /api/configs/jwt-customizer/{tokenTypePath} in the official Logto OpenAPI source.
 */
class LogtoGetJwtCustomizer extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_jwt_customizer',
  'class' => 'LogtoGetJwtCustomizer',
  'method' => 'GET',
  'path' => '/api/configs/jwt-customizer/{tokenTypePath}',
  'operation_id' => 'GetJwtCustomizer',
  'summary' => 'Get JWT customizer',
  'description' => 'Get the JWT customizer for the given token type.',
  'parameters' =>
  array (
    'token_type_path' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The token type to get the JWT customizer for.',
      'enum' =>
      array (
        0 => 'access-token',
        1 => 'client-credentials',
      ),
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}

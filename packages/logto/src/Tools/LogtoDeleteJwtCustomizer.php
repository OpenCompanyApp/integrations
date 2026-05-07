<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete JWT customizer.
 *
 * Maps to DELETE /api/configs/jwt-customizer/{tokenTypePath} in the official Logto OpenAPI source.
 */
class LogtoDeleteJwtCustomizer extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_jwt_customizer',
  'class' => 'LogtoDeleteJwtCustomizer',
  'method' => 'DELETE',
  'path' => '/api/configs/jwt-customizer/{tokenTypePath}',
  'operation_id' => 'DeleteJwtCustomizer',
  'summary' => 'Delete JWT customizer',
  'description' => 'Delete the JWT customizer for the given token type.',
  'parameters' =>
  array (
    'token_type_path' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The token type path to delete the JWT customizer for.',
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
  'type' => 'write',
);
}

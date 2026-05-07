<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get all JWT customizers.
 *
 * Maps to GET /api/configs/jwt-customizer in the official Logto OpenAPI source.
 */
class LogtoListJwtCustomizers extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_jwt_customizers',
  'class' => 'LogtoListJwtCustomizers',
  'method' => 'GET',
  'path' => '/api/configs/jwt-customizer',
  'operation_id' => 'ListJwtCustomizers',
  'summary' => 'Get all JWT customizers',
  'description' => 'Get all JWT customizers for the tenant.',
  'parameters' =>
  array (
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
  'content_type' => NULL,
  'type' => 'read',
);
}

<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Test JWT customizer.
 *
 * Maps to POST /api/configs/jwt-customizer/test in the official Logto OpenAPI source.
 */
class LogtoTestJwtCustomizer extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_test_jwt_customizer',
  'class' => 'LogtoTestJwtCustomizer',
  'method' => 'POST',
  'path' => '/api/configs/jwt-customizer/test',
  'operation_id' => 'TestJwtCustomizer',
  'summary' => 'Test JWT customizer',
  'description' => 'Test the JWT customizer script with the given sample context and sample token payload.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

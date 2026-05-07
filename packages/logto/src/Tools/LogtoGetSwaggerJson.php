<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get Swagger JSON.
 *
 * Maps to GET /api/swagger.json in the official Logto OpenAPI source.
 */
class LogtoGetSwaggerJson extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_swagger_json',
  'class' => 'LogtoGetSwaggerJson',
  'method' => 'GET',
  'path' => '/api/swagger.json',
  'operation_id' => 'GetSwaggerJson',
  'summary' => 'Get Swagger JSON',
  'description' => 'The endpoint for the current JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
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

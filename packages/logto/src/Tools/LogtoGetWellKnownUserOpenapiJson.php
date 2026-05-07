<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get User API swagger JSON.
 *
 * Maps to GET /api/.well-known/user.openapi.json in the official Logto OpenAPI source.
 */
class LogtoGetWellKnownUserOpenapiJson extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_well_known_user_openapi_json',
  'class' => 'LogtoGetWellKnownUserOpenapiJson',
  'method' => 'GET',
  'path' => '/api/.well-known/user.openapi.json',
  'operation_id' => 'GetWellKnownUserOpenapiJson',
  'summary' => 'Get User API swagger JSON',
  'description' => 'The endpoint for the User API JSON document. The JSON conforms to the [OpenAPI v3.0.1](https://spec.openapis.org/oas/v3.0.1) (a.k.a. Swagger) specification.',
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

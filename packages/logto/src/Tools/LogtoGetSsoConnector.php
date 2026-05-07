<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get SSO connector.
 *
 * Maps to GET /api/sso-connectors/{id} in the official Logto OpenAPI source.
 */
class LogtoGetSsoConnector extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_sso_connector',
  'class' => 'LogtoGetSsoConnector',
  'method' => 'GET',
  'path' => '/api/sso-connectors/{id}',
  'operation_id' => 'GetSsoConnector',
  'summary' => 'Get SSO connector',
  'description' => 'Get SSO connector data by ID. In addition to the raw SSO connector data, a copy of fetched or parsed IdP configs and a copy of connector provider\'s data will be attached.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the sso connector.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
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

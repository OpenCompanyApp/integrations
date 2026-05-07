<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get connector factory.
 *
 * Maps to GET /api/connector-factories/{id} in the official Logto OpenAPI source.
 */
class LogtoGetConnectorFactory extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_connector_factory',
  'class' => 'LogtoGetConnectorFactory',
  'method' => 'GET',
  'path' => '/api/connector-factories/{id}',
  'operation_id' => 'GetConnectorFactory',
  'summary' => 'Get connector factory',
  'description' => 'Get connector factory by the given ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the connector factory.',
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

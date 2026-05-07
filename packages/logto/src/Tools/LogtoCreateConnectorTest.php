<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Test passwordless connector.
 *
 * Maps to POST /api/connectors/{factoryId}/test in the official Logto OpenAPI source.
 */
class LogtoCreateConnectorTest extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_connector_test',
  'class' => 'LogtoCreateConnectorTest',
  'method' => 'POST',
  'path' => '/api/connectors/{factoryId}/test',
  'operation_id' => 'CreateConnectorTest',
  'summary' => 'Test passwordless connector',
  'description' => 'Test a passwordless (email or SMS) connector by sending a test message to the given phone number or email address.',
  'parameters' =>
  array (
    'factory_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the factory.',
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
    'factoryId' => 'factory_id',
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

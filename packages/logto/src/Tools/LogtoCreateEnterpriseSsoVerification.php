<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create enterprise SSO verification.
 *
 * Maps to POST /api/experience/verification/sso/{connectorId}/authorization-uri in the official Logto OpenAPI source.
 */
class LogtoCreateEnterpriseSsoVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_enterprise_sso_verification',
  'class' => 'LogtoCreateEnterpriseSsoVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/sso/{connectorId}/authorization-uri',
  'operation_id' => 'CreateEnterpriseSsoVerification',
  'summary' => 'Create enterprise SSO verification',
  'description' => 'Create a new EnterpriseSSO verification record and return the provider\'s authorization URI for the given connector.',
  'parameters' =>
  array (
    'connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the connector.',
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
    'connectorId' => 'connector_id',
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

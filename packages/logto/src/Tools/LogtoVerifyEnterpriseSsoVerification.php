<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify enterprise SSO verification.
 *
 * Maps to POST /api/experience/verification/sso/{connectorId}/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyEnterpriseSsoVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_enterprise_sso_verification',
  'class' => 'LogtoVerifyEnterpriseSsoVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/sso/{connectorId}/verify',
  'operation_id' => 'VerifyEnterpriseSsoVerification',
  'summary' => 'Verify enterprise SSO verification',
  'description' => 'Verify the SSO authorization response data and get the user\'s identity from the SSO provider.',
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

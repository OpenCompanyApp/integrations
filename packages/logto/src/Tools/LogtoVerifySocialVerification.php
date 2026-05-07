<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify social verification.
 *
 * Maps to POST /api/experience/verification/social/{connectorId}/verify in the official Logto OpenAPI source.
 */
class LogtoVerifySocialVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_social_verification',
  'class' => 'LogtoVerifySocialVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/social/{connectorId}/verify',
  'operation_id' => 'VerifySocialVerification',
  'summary' => 'Verify social verification',
  'description' => 'Verify the social authorization response data and get the user\'s identity data from the social provider.',
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

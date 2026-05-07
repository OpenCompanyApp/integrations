<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create social verification.
 *
 * Maps to POST /api/experience/verification/social/{connectorId}/authorization-uri in the official Logto OpenAPI source.
 */
class LogtoCreateSocialVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_social_verification',
  'class' => 'LogtoCreateSocialVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/social/{connectorId}/authorization-uri',
  'operation_id' => 'CreateSocialVerification',
  'summary' => 'Create social verification',
  'description' => 'Create a new SocialVerification record and return the provider\'s authorization URI for the given connector.',
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

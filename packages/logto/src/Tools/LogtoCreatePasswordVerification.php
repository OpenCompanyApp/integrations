<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create password verification record.
 *
 * Maps to POST /api/experience/verification/password in the official Logto OpenAPI source.
 */
class LogtoCreatePasswordVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_password_verification',
  'class' => 'LogtoCreatePasswordVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/password',
  'operation_id' => 'CreatePasswordVerification',
  'summary' => 'Create password verification record',
  'description' => 'Create and verify a new Password verification record. The verification record can only be created if the provided user credentials are correct.',
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

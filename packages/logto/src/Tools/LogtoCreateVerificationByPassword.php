<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create a record by password.
 *
 * Maps to POST /api/verifications/password in the official Logto OpenAPI source.
 */
class LogtoCreateVerificationByPassword extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_verification_by_password',
  'class' => 'LogtoCreateVerificationByPassword',
  'method' => 'POST',
  'path' => '/api/verifications/password',
  'operation_id' => 'CreateVerificationByPassword',
  'summary' => 'Create a record by password',
  'description' => 'Create a verification record by verifying the password.',
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

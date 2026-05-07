<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create a social verification record.
 *
 * Maps to POST /api/verifications/social in the official Logto OpenAPI source.
 */
class LogtoCreateVerificationBySocial extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_verification_by_social',
  'class' => 'LogtoCreateVerificationBySocial',
  'method' => 'POST',
  'path' => '/api/verifications/social',
  'operation_id' => 'CreateVerificationBySocial',
  'summary' => 'Create a social verification record',
  'description' => 'Create a social verification record and return the authorization URI.',
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

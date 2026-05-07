<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create a new subject token.
 *
 * Maps to POST /api/subject-tokens in the official Logto OpenAPI source.
 */
class LogtoCreateSubjectToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_subject_token',
  'class' => 'LogtoCreateSubjectToken',
  'method' => 'POST',
  'path' => '/api/subject-tokens',
  'operation_id' => 'CreateSubjectToken',
  'summary' => 'Create a new subject token',
  'description' => 'Create a new subject token for the use of impersonating the user.',
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

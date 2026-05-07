<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get email template by ID.
 *
 * Maps to GET /api/email-templates/{id} in the official Logto OpenAPI source.
 */
class LogtoGetEmailTemplate extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_email_template',
  'class' => 'LogtoGetEmailTemplate',
  'method' => 'GET',
  'path' => '/api/email-templates/{id}',
  'operation_id' => 'GetEmailTemplate',
  'summary' => 'Get email template by ID',
  'description' => 'Get the email template by its ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the email template.',
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

<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete an email template.
 *
 * Maps to DELETE /api/email-templates/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteEmailTemplate extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_email_template',
  'class' => 'LogtoDeleteEmailTemplate',
  'method' => 'DELETE',
  'path' => '/api/email-templates/{id}',
  'operation_id' => 'DeleteEmailTemplate',
  'summary' => 'Delete an email template',
  'description' => 'Delete an email template by its ID.',
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
  'type' => 'write',
);
}

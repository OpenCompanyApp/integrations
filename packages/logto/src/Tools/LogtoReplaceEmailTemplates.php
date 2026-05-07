<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace email templates.
 *
 * Maps to PUT /api/email-templates in the official Logto OpenAPI source.
 */
class LogtoReplaceEmailTemplates extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_email_templates',
  'class' => 'LogtoReplaceEmailTemplates',
  'method' => 'PUT',
  'path' => '/api/email-templates',
  'operation_id' => 'ReplaceEmailTemplates',
  'summary' => 'Replace email templates',
  'description' => 'Create or replace a list of email templates. If an email template with the same language tag and template type already exists, its details will be updated.',
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

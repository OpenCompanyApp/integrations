<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update email template details.
 *
 * Maps to PATCH /api/email-templates/{id}/details in the official Logto OpenAPI source.
 */
class LogtoUpdateEmailTemplateDetails extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_email_template_details',
  'class' => 'LogtoUpdateEmailTemplateDetails',
  'method' => 'PATCH',
  'path' => '/api/email-templates/{id}/details',
  'operation_id' => 'UpdateEmailTemplateDetails',
  'summary' => 'Update email template details',
  'description' => 'Update the details of an email template by its ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the email template.',
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
    'id' => 'id',
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

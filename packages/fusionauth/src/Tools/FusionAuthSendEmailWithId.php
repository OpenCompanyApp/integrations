<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * send Email With Id.
 *
 * Maps to POST /api/email/send/{emailTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthSendEmailWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_send_email_with_id',
  'class' => 'FusionAuthSendEmailWithId',
  'method' => 'POST',
  'path' => '/api/email/send/{emailTemplateId}',
  'operation_id' => 'sendEmailWithId',
  'summary' => 'send Email With Id',
  'description' => 'Send an email using an email template Id. You can optionally provide requestData to access key value pairs in the email template.',
  'parameters' =>
  array (
    'email_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the template.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'emailTemplateId' => 'email_template_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

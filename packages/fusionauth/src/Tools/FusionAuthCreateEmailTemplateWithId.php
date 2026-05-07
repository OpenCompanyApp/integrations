<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Email Template With Id.
 *
 * Maps to POST /api/email/template/{emailTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateEmailTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_email_template_with_id',
  'class' => 'FusionAuthCreateEmailTemplateWithId',
  'method' => 'POST',
  'path' => '/api/email/template/{emailTemplateId}',
  'operation_id' => 'createEmailTemplateWithId',
  'summary' => 'create Email Template With Id',
  'description' => 'Creates an email template. You can optionally specify an Id for the template, if not provided one will be generated.',
  'parameters' =>
  array (
    'email_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the template. If not provided a secure random UUID will be generated.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
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
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Email Template With Id.
 *
 * Maps to PUT /api/email/template/{emailTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateEmailTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_email_template_with_id',
  'class' => 'FusionAuthUpdateEmailTemplateWithId',
  'method' => 'PUT',
  'path' => '/api/email/template/{emailTemplateId}',
  'operation_id' => 'updateEmailTemplateWithId',
  'summary' => 'update Email Template With Id',
  'description' => 'Updates the email template with the given Id.',
  'parameters' =>
  array (
    'email_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the email template to update.',
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

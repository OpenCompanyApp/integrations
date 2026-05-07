<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Email Template With Id.
 *
 * Maps to DELETE /api/email/template/{emailTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteEmailTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_email_template_with_id',
  'class' => 'FusionAuthDeleteEmailTemplateWithId',
  'method' => 'DELETE',
  'path' => '/api/email/template/{emailTemplateId}',
  'operation_id' => 'deleteEmailTemplateWithId',
  'summary' => 'delete Email Template With Id',
  'description' => 'Deletes the email template for the given Id.',
  'parameters' =>
  array (
    'email_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the email template to delete.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}

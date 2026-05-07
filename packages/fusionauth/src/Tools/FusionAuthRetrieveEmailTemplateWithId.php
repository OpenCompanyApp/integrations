<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Email Template With Id.
 *
 * Maps to GET /api/email/template/{emailTemplateId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveEmailTemplateWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_email_template_with_id',
  'class' => 'FusionAuthRetrieveEmailTemplateWithId',
  'method' => 'GET',
  'path' => '/api/email/template/{emailTemplateId}',
  'operation_id' => 'retrieveEmailTemplateWithId',
  'summary' => 'retrieve Email Template With Id',
  'description' => 'Retrieves the email template for the given Id. If you don\'t specify the Id, this will return all the email templates.',
  'parameters' =>
  array (
    'email_template_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the email template.',
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
  'type' => 'read',
);
}

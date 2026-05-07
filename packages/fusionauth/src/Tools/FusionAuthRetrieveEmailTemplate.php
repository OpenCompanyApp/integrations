<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Email Template.
 *
 * Maps to GET /api/email/template in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveEmailTemplate extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_email_template',
  'class' => 'FusionAuthRetrieveEmailTemplate',
  'method' => 'GET',
  'path' => '/api/email/template',
  'operation_id' => 'retrieveEmailTemplate',
  'summary' => 'retrieve Email Template',
  'description' => 'Retrieves the email template for the given Id. If you don\'t specify the Id, this will return all the email templates.',
  'parameters' =>
  array (
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
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
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}

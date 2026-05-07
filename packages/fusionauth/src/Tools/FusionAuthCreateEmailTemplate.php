<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Email Template.
 *
 * Maps to POST /api/email/template in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateEmailTemplate extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_email_template',
  'class' => 'FusionAuthCreateEmailTemplate',
  'method' => 'POST',
  'path' => '/api/email/template',
  'operation_id' => 'createEmailTemplate',
  'summary' => 'create Email Template',
  'description' => 'Creates an email template. You can optionally specify an Id for the template, if not provided one will be generated.',
  'parameters' =>
  array (
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

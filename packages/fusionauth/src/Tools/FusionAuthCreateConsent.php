<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Consent.
 *
 * Maps to POST /api/consent in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateConsent extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_consent',
  'class' => 'FusionAuthCreateConsent',
  'method' => 'POST',
  'path' => '/api/consent',
  'operation_id' => 'createConsent',
  'summary' => 'create Consent',
  'description' => 'Creates a user consent type. You can optionally specify an Id for the consent type, if not provided one will be generated.',
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

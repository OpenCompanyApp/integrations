<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Consent With Id.
 *
 * Maps to POST /api/consent/{consentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_consent_with_id',
  'class' => 'FusionAuthCreateConsentWithId',
  'method' => 'POST',
  'path' => '/api/consent/{consentId}',
  'operation_id' => 'createConsentWithId',
  'summary' => 'create Consent With Id',
  'description' => 'Creates a user consent type. You can optionally specify an Id for the consent type, if not provided one will be generated.',
  'parameters' =>
  array (
    'consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the consent. If not provided a secure random UUID will be generated.',
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
    'consentId' => 'consent_id',
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

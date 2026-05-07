<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Consent With Id.
 *
 * Maps to PATCH /api/consent/{consentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_consent_with_id',
  'class' => 'FusionAuthPatchConsentWithId',
  'method' => 'PATCH',
  'path' => '/api/consent/{consentId}',
  'operation_id' => 'patchConsentWithId',
  'summary' => 'patch Consent With Id',
  'description' => 'Updates, via PATCH, the consent with the given Id.',
  'parameters' =>
  array (
    'consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the consent to update.',
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

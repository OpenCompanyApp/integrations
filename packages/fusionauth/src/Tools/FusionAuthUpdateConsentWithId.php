<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Consent With Id.
 *
 * Maps to PUT /api/consent/{consentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_consent_with_id',
  'class' => 'FusionAuthUpdateConsentWithId',
  'method' => 'PUT',
  'path' => '/api/consent/{consentId}',
  'operation_id' => 'updateConsentWithId',
  'summary' => 'update Consent With Id',
  'description' => 'Updates the consent with the given Id.',
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

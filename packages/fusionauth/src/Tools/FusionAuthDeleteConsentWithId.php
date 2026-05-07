<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Consent With Id.
 *
 * Maps to DELETE /api/consent/{consentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_consent_with_id',
  'class' => 'FusionAuthDeleteConsentWithId',
  'method' => 'DELETE',
  'path' => '/api/consent/{consentId}',
  'operation_id' => 'deleteConsentWithId',
  'summary' => 'delete Consent With Id',
  'description' => 'Deletes the consent for the given Id.',
  'parameters' =>
  array (
    'consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the consent to delete.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}

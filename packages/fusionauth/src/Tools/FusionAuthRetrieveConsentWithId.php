<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Consent With Id.
 *
 * Maps to GET /api/consent/{consentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_consent_with_id',
  'class' => 'FusionAuthRetrieveConsentWithId',
  'method' => 'GET',
  'path' => '/api/consent/{consentId}',
  'operation_id' => 'retrieveConsentWithId',
  'summary' => 'retrieve Consent With Id',
  'description' => 'Retrieves the Consent for the given Id.',
  'parameters' =>
  array (
    'consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the consent.',
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
  'type' => 'read',
);
}

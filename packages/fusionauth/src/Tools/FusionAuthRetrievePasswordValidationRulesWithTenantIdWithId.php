<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Password Validation Rules With Tenant Id With Id.
 *
 * Maps to GET /api/tenant/password-validation-rules/{tenantId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrievePasswordValidationRulesWithTenantIdWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_password_validation_rules_with_tenant_id_with_id',
  'class' => 'FusionAuthRetrievePasswordValidationRulesWithTenantIdWithId',
  'method' => 'GET',
  'path' => '/api/tenant/password-validation-rules/{tenantId}',
  'operation_id' => 'retrievePasswordValidationRulesWithTenantIdWithId',
  'summary' => 'retrieve Password Validation Rules With Tenant Id With Id',
  'description' => 'Retrieves the password validation rules for a specific tenant. This API does not require an API key.',
  'parameters' =>
  array (
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the tenant.',
    ),
  ),
  'path_params' =>
  array (
    'tenantId' => 'tenant_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}

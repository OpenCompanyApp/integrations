<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Password Validation Rules With Id.
 *
 * Maps to GET /api/tenant/password-validation-rules in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrievePasswordValidationRulesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_password_validation_rules_with_id',
  'class' => 'FusionAuthRetrievePasswordValidationRulesWithId',
  'method' => 'GET',
  'path' => '/api/tenant/password-validation-rules',
  'operation_id' => 'retrievePasswordValidationRulesWithId',
  'summary' => 'retrieve Password Validation Rules With Id',
  'description' => 'Retrieves the password validation rules for a specific tenant. This method requires a tenantId to be provided through the use of a Tenant scoped API key or an HTTP header X-FusionAuth-TenantId to specify the Tenant Id. This API does not require an API key.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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

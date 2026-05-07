<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Consent With Id.
 *
 * Maps to POST /api/user/consent/{userConsentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_consent_with_id',
  'class' => 'FusionAuthCreateUserConsentWithId',
  'method' => 'POST',
  'path' => '/api/user/consent/{userConsentId}',
  'operation_id' => 'createUserConsentWithId',
  'summary' => 'create User Consent With Id',
  'description' => 'Creates a single User consent.',
  'parameters' =>
  array (
    'user_consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the User consent. If not provided a secure random UUID will be generated.',
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
    'userConsentId' => 'user_consent_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

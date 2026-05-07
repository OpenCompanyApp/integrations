<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Consent With Id.
 *
 * Maps to GET /api/user/consent/{userConsentId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserConsentWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_consent_with_id',
  'class' => 'FusionAuthRetrieveUserConsentWithId',
  'method' => 'GET',
  'path' => '/api/user/consent/{userConsentId}',
  'operation_id' => 'retrieveUserConsentWithId',
  'summary' => 'retrieve User Consent With Id',
  'description' => 'Retrieve a single User consent by Id.',
  'parameters' =>
  array (
    'user_consent_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The User consent Id',
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
  'content_type' => NULL,
  'type' => 'read',
);
}

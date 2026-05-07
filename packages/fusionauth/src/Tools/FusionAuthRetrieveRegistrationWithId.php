<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Registration With Id.
 *
 * Maps to GET /api/user/registration/{userId}/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveRegistrationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_registration_with_id',
  'class' => 'FusionAuthRetrieveRegistrationWithId',
  'method' => 'GET',
  'path' => '/api/user/registration/{userId}/{applicationId}',
  'operation_id' => 'retrieveRegistrationWithId',
  'summary' => 'retrieve Registration With Id',
  'description' => 'Retrieves the user registration for the user with the given Id and the given application Id.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application.',
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
    'userId' => 'user_id',
    'applicationId' => 'application_id',
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

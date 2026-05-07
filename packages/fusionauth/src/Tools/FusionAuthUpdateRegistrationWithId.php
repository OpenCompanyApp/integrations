<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Registration With Id.
 *
 * Maps to PUT /api/user/registration/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateRegistrationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_registration_with_id',
  'class' => 'FusionAuthUpdateRegistrationWithId',
  'method' => 'PUT',
  'path' => '/api/user/registration/{userId}',
  'operation_id' => 'updateRegistrationWithId',
  'summary' => 'update Registration With Id',
  'description' => 'Updates the registration for the user with the given Id and the application defined in the request.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user whose registration is going to be updated.',
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
    'userId' => 'user_id',
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

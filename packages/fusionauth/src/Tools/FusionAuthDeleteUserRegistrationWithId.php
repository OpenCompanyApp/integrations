<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete User Registration With Id.
 *
 * Maps to DELETE /api/user/registration/{userId}/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteUserRegistrationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_user_registration_with_id',
  'class' => 'FusionAuthDeleteUserRegistrationWithId',
  'method' => 'DELETE',
  'path' => '/api/user/registration/{userId}/{applicationId}',
  'operation_id' => 'deleteUserRegistrationWithId',
  'summary' => 'delete User Registration With Id',
  'description' => 'Deletes the user registration for the given user and application along with the given JSON body that contains the event information. OR Deletes the user registration for the given user and application.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user whose registration is being deleted.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application to remove the registration for.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}

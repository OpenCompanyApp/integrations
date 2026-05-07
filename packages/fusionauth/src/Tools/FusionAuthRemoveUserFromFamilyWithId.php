<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * remove User From Family With Id.
 *
 * Maps to DELETE /api/user/family/{familyId}/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRemoveUserFromFamilyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_remove_user_from_family_with_id',
  'class' => 'FusionAuthRemoveUserFromFamilyWithId',
  'method' => 'DELETE',
  'path' => '/api/user/family/{familyId}/{userId}',
  'operation_id' => 'removeUserFromFamilyWithId',
  'summary' => 'remove User From Family With Id',
  'description' => 'Removes a user from the family with the given Id.',
  'parameters' =>
  array (
    'family_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the family to remove the user from.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user to remove from the family.',
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
    'familyId' => 'family_id',
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
  'content_type' => NULL,
  'type' => 'write',
);
}

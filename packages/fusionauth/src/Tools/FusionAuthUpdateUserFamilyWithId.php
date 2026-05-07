<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update User Family With Id.
 *
 * Maps to PUT /api/user/family/{familyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateUserFamilyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_user_family_with_id',
  'class' => 'FusionAuthUpdateUserFamilyWithId',
  'method' => 'PUT',
  'path' => '/api/user/family/{familyId}',
  'operation_id' => 'updateUserFamilyWithId',
  'summary' => 'update User Family With Id',
  'description' => 'Updates a family with a given Id. OR Adds a user to an existing family. The family Id must be specified.',
  'parameters' =>
  array (
    'family_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the family to update.',
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
    'familyId' => 'family_id',
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

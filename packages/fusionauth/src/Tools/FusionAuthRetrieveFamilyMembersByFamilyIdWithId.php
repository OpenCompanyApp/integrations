<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Family Members By Family Id With Id.
 *
 * Maps to GET /api/user/family/{familyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveFamilyMembersByFamilyIdWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_family_members_by_family_id_with_id',
  'class' => 'FusionAuthRetrieveFamilyMembersByFamilyIdWithId',
  'method' => 'GET',
  'path' => '/api/user/family/{familyId}',
  'operation_id' => 'retrieveFamilyMembersByFamilyIdWithId',
  'summary' => 'retrieve Family Members By Family Id With Id',
  'description' => 'Retrieves all the members of a family by the unique Family Id.',
  'parameters' =>
  array (
    'family_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique Id of the Family.',
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

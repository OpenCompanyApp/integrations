<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch IPAccess Control List With Id.
 *
 * Maps to PATCH /api/ip-acl/{accessControlListId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchIpaccessControlListWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_ipaccess_control_list_with_id',
  'class' => 'FusionAuthPatchIpaccessControlListWithId',
  'method' => 'PATCH',
  'path' => '/api/ip-acl/{accessControlListId}',
  'operation_id' => 'patchIPAccessControlListWithId',
  'summary' => 'patch IPAccess Control List With Id',
  'description' => 'Update the IP Access Control List with the given Id.',
  'parameters' =>
  array (
    'access_control_list_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the IP Access Control List to patch.',
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
    'accessControlListId' => 'access_control_list_id',
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

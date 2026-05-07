<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update IPAccess Control List With Id.
 *
 * Maps to PUT /api/ip-acl/{accessControlListId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateIpaccessControlListWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_ipaccess_control_list_with_id',
  'class' => 'FusionAuthUpdateIpaccessControlListWithId',
  'method' => 'PUT',
  'path' => '/api/ip-acl/{accessControlListId}',
  'operation_id' => 'updateIPAccessControlListWithId',
  'summary' => 'update IPAccess Control List With Id',
  'description' => 'Updates the IP Access Control List with the given Id.',
  'parameters' =>
  array (
    'access_control_list_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the IP Access Control List to update.',
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

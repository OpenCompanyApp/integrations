<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete IPAccess Control List With Id.
 *
 * Maps to DELETE /api/ip-acl/{ipAccessControlListId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteIpaccessControlListWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_ipaccess_control_list_with_id',
  'class' => 'FusionAuthDeleteIpaccessControlListWithId',
  'method' => 'DELETE',
  'path' => '/api/ip-acl/{ipAccessControlListId}',
  'operation_id' => 'deleteIPAccessControlListWithId',
  'summary' => 'delete IPAccess Control List With Id',
  'description' => 'Deletes the IP Access Control List for the given Id.',
  'parameters' =>
  array (
    'ip_access_control_list_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the IP Access Control List to delete.',
    ),
  ),
  'path_params' =>
  array (
    'ipAccessControlListId' => 'ip_access_control_list_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}

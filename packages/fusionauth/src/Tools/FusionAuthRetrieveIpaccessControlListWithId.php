<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve IPAccess Control List With Id.
 *
 * Maps to GET /api/ip-acl/{ipAccessControlListId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveIpaccessControlListWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_ipaccess_control_list_with_id',
  'class' => 'FusionAuthRetrieveIpaccessControlListWithId',
  'method' => 'GET',
  'path' => '/api/ip-acl/{ipAccessControlListId}',
  'operation_id' => 'retrieveIPAccessControlListWithId',
  'summary' => 'retrieve IPAccess Control List With Id',
  'description' => 'Retrieves the IP Access Control List with the given Id.',
  'parameters' =>
  array (
    'ip_access_control_list_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the IP Access Control List.',
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
  'type' => 'read',
);
}

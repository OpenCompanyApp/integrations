<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create IPAccess Control List With Id.
 *
 * Maps to POST /api/ip-acl/{accessControlListId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateIpaccessControlListWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_ipaccess_control_list_with_id',
  'class' => 'FusionAuthCreateIpaccessControlListWithId',
  'method' => 'POST',
  'path' => '/api/ip-acl/{accessControlListId}',
  'operation_id' => 'createIPAccessControlListWithId',
  'summary' => 'create IPAccess Control List With Id',
  'description' => 'Creates an IP Access Control List. You can optionally specify an Id on this create request, if one is not provided one will be generated.',
  'parameters' =>
  array (
    'access_control_list_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the IP Access Control List. If not provided a secure random UUID will be generated.',
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

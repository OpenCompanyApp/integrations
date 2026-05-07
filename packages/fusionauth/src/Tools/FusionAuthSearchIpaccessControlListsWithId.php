<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search IPAccess Control Lists With Id.
 *
 * Maps to POST /api/ip-acl/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchIpaccessControlListsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_ipaccess_control_lists_with_id',
  'class' => 'FusionAuthSearchIpaccessControlListsWithId',
  'method' => 'POST',
  'path' => '/api/ip-acl/search',
  'operation_id' => 'searchIPAccessControlListsWithId',
  'summary' => 'search IPAccess Control Lists With Id',
  'description' => 'Searches the IP Access Control Lists with the specified criteria and pagination.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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

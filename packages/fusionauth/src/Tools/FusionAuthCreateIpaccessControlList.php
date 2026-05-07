<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create IPAccess Control List.
 *
 * Maps to POST /api/ip-acl in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateIpaccessControlList extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_ipaccess_control_list',
  'class' => 'FusionAuthCreateIpaccessControlList',
  'method' => 'POST',
  'path' => '/api/ip-acl',
  'operation_id' => 'createIPAccessControlList',
  'summary' => 'create IPAccess Control List',
  'description' => 'Creates an IP Access Control List. You can optionally specify an Id on this create request, if one is not provided one will be generated.',
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

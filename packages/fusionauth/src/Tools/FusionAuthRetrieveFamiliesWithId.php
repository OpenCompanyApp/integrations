<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Families With Id.
 *
 * Maps to GET /api/user/family in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveFamiliesWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_families_with_id',
  'class' => 'FusionAuthRetrieveFamiliesWithId',
  'method' => 'GET',
  'path' => '/api/user/family',
  'operation_id' => 'retrieveFamiliesWithId',
  'summary' => 'retrieve Families With Id',
  'description' => 'Retrieves all the families that a user belongs to.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The User\'s id',
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
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
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

<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Family With Id.
 *
 * Maps to POST /api/user/family/{familyId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateFamilyWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_family_with_id',
  'class' => 'FusionAuthCreateFamilyWithId',
  'method' => 'POST',
  'path' => '/api/user/family/{familyId}',
  'operation_id' => 'createFamilyWithId',
  'summary' => 'create Family With Id',
  'description' => 'Creates a family with the user Id in the request as the owner and sole member of the family. You can optionally specify an Id for the family, if not provided one will be generated.',
  'parameters' =>
  array (
    'family_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the family. If not provided a secure random UUID will be generated.',
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

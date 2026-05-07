<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * comment On User With Id.
 *
 * Maps to POST /api/user/comment in the official FusionAuth OpenAPI document.
 */
class FusionAuthCommentOnUserWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_comment_on_user_with_id',
  'class' => 'FusionAuthCommentOnUserWithId',
  'method' => 'POST',
  'path' => '/api/user/comment',
  'operation_id' => 'commentOnUserWithId',
  'summary' => 'comment On User With Id',
  'description' => 'Adds a comment to the user\'s account.',
  'parameters' =>
  array (
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

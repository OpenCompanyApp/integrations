<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search User Comments With Id.
 *
 * Maps to POST /api/user/comment/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchUserCommentsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_user_comments_with_id',
  'class' => 'FusionAuthSearchUserCommentsWithId',
  'method' => 'POST',
  'path' => '/api/user/comment/search',
  'operation_id' => 'searchUserCommentsWithId',
  'summary' => 'search User Comments With Id',
  'description' => 'Searches user comments with the specified criteria and pagination.',
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

<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Link With Id.
 *
 * Maps to POST /api/identity-provider/link in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserLinkWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_link_with_id',
  'class' => 'FusionAuthCreateUserLinkWithId',
  'method' => 'POST',
  'path' => '/api/identity-provider/link',
  'operation_id' => 'createUserLinkWithId',
  'summary' => 'create User Link With Id',
  'description' => 'Link an external user from a 3rd party identity provider to a FusionAuth user.',
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

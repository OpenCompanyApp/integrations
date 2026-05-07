<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * action User With Id.
 *
 * Maps to POST /api/user/action in the official FusionAuth OpenAPI document.
 */
class FusionAuthActionUserWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_action_user_with_id',
  'class' => 'FusionAuthActionUserWithId',
  'method' => 'POST',
  'path' => '/api/user/action',
  'operation_id' => 'actionUserWithId',
  'summary' => 'action User With Id',
  'description' => 'Takes an action on a user. The user being actioned is called the "actionee" and the user taking the action is called the "actioner". Both user ids are required in the request object.',
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

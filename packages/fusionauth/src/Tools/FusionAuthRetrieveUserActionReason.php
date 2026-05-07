<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Action Reason.
 *
 * Maps to GET /api/user-action-reason in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserActionReason extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_action_reason',
  'class' => 'FusionAuthRetrieveUserActionReason',
  'method' => 'GET',
  'path' => '/api/user-action-reason',
  'operation_id' => 'retrieveUserActionReason',
  'summary' => 'retrieve User Action Reason',
  'description' => 'Retrieves the user action reason for the given Id. If you pass in null for the Id, this will return all the user action reasons.',
  'parameters' =>
  array (
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
  'content_type' => NULL,
  'type' => 'read',
);
}

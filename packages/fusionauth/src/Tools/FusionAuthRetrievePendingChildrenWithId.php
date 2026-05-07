<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Pending Children With Id.
 *
 * Maps to GET /api/user/family/pending in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrievePendingChildrenWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_pending_children_with_id',
  'class' => 'FusionAuthRetrievePendingChildrenWithId',
  'method' => 'GET',
  'path' => '/api/user/family/pending',
  'operation_id' => 'retrievePendingChildrenWithId',
  'summary' => 'retrieve Pending Children With Id',
  'description' => 'Retrieves all the children for the given parent email address.',
  'parameters' =>
  array (
    'parent_email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The email of the parent.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'parentEmail' => 'parent_email',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}

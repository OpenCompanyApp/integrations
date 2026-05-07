<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Pending Link With Id.
 *
 * Maps to GET /api/identity-provider/link/pending/{pendingLinkId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrievePendingLinkWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_pending_link_with_id',
  'class' => 'FusionAuthRetrievePendingLinkWithId',
  'method' => 'GET',
  'path' => '/api/identity-provider/link/pending/{pendingLinkId}',
  'operation_id' => 'retrievePendingLinkWithId',
  'summary' => 'retrieve Pending Link With Id',
  'description' => 'Retrieve a pending identity provider link. This is useful to validate a pending link and retrieve meta-data about the identity provider link.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The optional userId. When provided additional meta-data will be provided to identify how many links if any the user already has.',
    ),
    'pending_link_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The pending link Id.',
    ),
  ),
  'path_params' =>
  array (
    'pendingLinkId' => 'pending_link_id',
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}

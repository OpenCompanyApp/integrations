<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Version With Id.
 *
 * Maps to GET /api/system/version in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveVersionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_version_with_id',
  'class' => 'FusionAuthRetrieveVersionWithId',
  'method' => 'GET',
  'path' => '/api/system/version',
  'operation_id' => 'retrieveVersionWithId',
  'summary' => 'retrieve Version With Id',
  'description' => 'Retrieves the FusionAuth version string.',
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

<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Login Records With Id.
 *
 * Maps to POST /api/system/login-record/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchLoginRecordsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_login_records_with_id',
  'class' => 'FusionAuthSearchLoginRecordsWithId',
  'method' => 'POST',
  'path' => '/api/system/login-record/search',
  'operation_id' => 'searchLoginRecordsWithId',
  'summary' => 'search Login Records With Id',
  'description' => 'Searches the login records with the specified criteria and pagination.',
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

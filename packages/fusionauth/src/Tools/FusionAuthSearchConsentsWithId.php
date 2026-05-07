<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Consents With Id.
 *
 * Maps to POST /api/consent/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchConsentsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_consents_with_id',
  'class' => 'FusionAuthSearchConsentsWithId',
  'method' => 'POST',
  'path' => '/api/consent/search',
  'operation_id' => 'searchConsentsWithId',
  'summary' => 'search Consents With Id',
  'description' => 'Searches consents with the specified criteria and pagination.',
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

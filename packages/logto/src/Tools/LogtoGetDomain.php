<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get domain.
 *
 * Maps to GET /api/domains/{id} in the official Logto OpenAPI source.
 */
class LogtoGetDomain extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_domain',
  'class' => 'LogtoGetDomain',
  'method' => 'GET',
  'path' => '/api/domains/{id}',
  'operation_id' => 'GetDomain',
  'summary' => 'Get domain',
  'description' => 'Get domain details by ID, by calling this API, the domain status will be synced from remote provider.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the domain.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
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

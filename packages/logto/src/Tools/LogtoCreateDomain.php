<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create domain.
 *
 * Maps to POST /api/domains in the official Logto OpenAPI source.
 */
class LogtoCreateDomain extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_domain',
  'class' => 'LogtoCreateDomain',
  'method' => 'POST',
  'path' => '/api/domains',
  'operation_id' => 'CreateDomain',
  'summary' => 'Create domain',
  'description' => 'Create a new domain with the given data. The maximum domain number is 1, once created, can not be modified, you\'ll have to delete and recreate one.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

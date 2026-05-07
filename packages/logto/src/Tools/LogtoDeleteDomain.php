<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete domain.
 *
 * Maps to DELETE /api/domains/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteDomain extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_domain',
  'class' => 'LogtoDeleteDomain',
  'method' => 'DELETE',
  'path' => '/api/domains/{id}',
  'operation_id' => 'DeleteDomain',
  'summary' => 'Delete domain',
  'description' => 'Delete domain by ID.',
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
  'type' => 'write',
);
}

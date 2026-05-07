<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Init new interaction.
 *
 * Maps to PUT /api/experience in the official Logto OpenAPI source.
 */
class LogtoInitInteraction extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_init_interaction',
  'class' => 'LogtoInitInteraction',
  'method' => 'PUT',
  'path' => '/api/experience',
  'operation_id' => 'InitInteraction',
  'summary' => 'Init new interaction',
  'description' => 'Init a new experience interaction with the given interaction type. Any existing interaction data will be cleared.',
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

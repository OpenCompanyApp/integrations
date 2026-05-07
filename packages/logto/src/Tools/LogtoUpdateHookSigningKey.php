<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update signing key for a hook.
 *
 * Maps to PATCH /api/hooks/{id}/signing-key in the official Logto OpenAPI source.
 */
class LogtoUpdateHookSigningKey extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_hook_signing_key',
  'class' => 'LogtoUpdateHookSigningKey',
  'method' => 'PATCH',
  'path' => '/api/hooks/{id}/signing-key',
  'operation_id' => 'UpdateHookSigningKey',
  'summary' => 'Update signing key for a hook',
  'description' => 'Update the signing key for the specified hook.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the hook.',
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

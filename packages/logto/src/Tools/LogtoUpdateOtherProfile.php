<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update other profile.
 *
 * Maps to PATCH /api/my-account/profile in the official Logto OpenAPI source.
 */
class LogtoUpdateOtherProfile extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_other_profile',
  'class' => 'LogtoUpdateOtherProfile',
  'method' => 'PATCH',
  'path' => '/api/my-account/profile',
  'operation_id' => 'UpdateOtherProfile',
  'summary' => 'Update other profile',
  'description' => 'Update other profile for the user, only the fields that are passed in will be updated, to update the address, the user must have the address scope.',
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

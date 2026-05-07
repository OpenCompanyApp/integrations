<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update the display order of the custom profile fields in Sign-in Experience.
 *
 * Maps to POST /api/custom-profile-fields/properties/sie-order in the official Logto OpenAPI source.
 */
class LogtoUpdateCustomProfileFieldsSieOrder extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_custom_profile_fields_sie_order',
  'class' => 'LogtoUpdateCustomProfileFieldsSieOrder',
  'method' => 'POST',
  'path' => '/api/custom-profile-fields/properties/sie-order',
  'operation_id' => 'UpdateCustomProfileFieldsSieOrder',
  'summary' => 'Update the display order of the custom profile fields in Sign-in Experience',
  'description' => 'Update the display order of the custom profile fields in Sign-in Experience.',
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

<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update default sign-in experience settings.
 *
 * Maps to PATCH /api/sign-in-exp in the official Logto OpenAPI source.
 */
class LogtoUpdateSignInExp extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_sign_in_exp',
  'class' => 'LogtoUpdateSignInExp',
  'method' => 'PATCH',
  'path' => '/api/sign-in-exp',
  'operation_id' => 'UpdateSignInExp',
  'summary' => 'Update default sign-in experience settings',
  'description' => 'Update the default sign-in experience settings with the provided data.',
  'parameters' =>
  array (
    'remove_unused_demo_social_connector' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Whether to remove unused demo social connectors. (These demo social connectors are only used during cloud user onboarding)',
    ),
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
    'removeUnusedDemoSocialConnector' => 'remove_unused_demo_social_connector',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

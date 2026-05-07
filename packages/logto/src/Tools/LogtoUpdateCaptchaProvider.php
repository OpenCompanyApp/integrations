<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update captcha provider.
 *
 * Maps to PUT /api/captcha-provider in the official Logto OpenAPI source.
 */
class LogtoUpdateCaptchaProvider extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_captcha_provider',
  'class' => 'LogtoUpdateCaptchaProvider',
  'method' => 'PUT',
  'path' => '/api/captcha-provider',
  'operation_id' => 'UpdateCaptchaProvider',
  'summary' => 'Update captcha provider',
  'description' => 'Update the captcha provider with the provided settings.',
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

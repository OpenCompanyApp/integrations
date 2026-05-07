<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get captcha provider.
 *
 * Maps to GET /api/captcha-provider in the official Logto OpenAPI source.
 */
class LogtoGetCaptchaProvider extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_captcha_provider',
  'class' => 'LogtoGetCaptchaProvider',
  'method' => 'GET',
  'path' => '/api/captcha-provider',
  'operation_id' => 'GetCaptchaProvider',
  'summary' => 'Get captcha provider',
  'description' => 'Get the captcha provider, you can only have one captcha provider.',
  'parameters' =>
  array (
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
  'content_type' => NULL,
  'type' => 'read',
);
}

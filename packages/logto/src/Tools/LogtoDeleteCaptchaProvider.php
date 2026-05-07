<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete captcha provider.
 *
 * Maps to DELETE /api/captcha-provider in the official Logto OpenAPI source.
 */
class LogtoDeleteCaptchaProvider extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_captcha_provider',
  'class' => 'LogtoDeleteCaptchaProvider',
  'method' => 'DELETE',
  'path' => '/api/captcha-provider',
  'operation_id' => 'DeleteCaptchaProvider',
  'summary' => 'Delete captcha provider',
  'description' => 'Delete the captcha provider.',
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
  'type' => 'write',
);
}

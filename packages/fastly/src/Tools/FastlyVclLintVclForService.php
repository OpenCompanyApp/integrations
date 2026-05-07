<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Lint (validate) VCL using flags set for the service.
 *
 * Maps to Fastly generated client operation VclApi::lintVclForService (POST /service/{service_id}/lint).
 */
class FastlyVclLintVclForService extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_lint_vcl_for_service';
    protected const DESCRIPTION = 'Lint (validate) VCL using flags set for the service.

Official Fastly client operation: VclApi::lintVclForService
Endpoint: POST /service/{service_id}/lint

Lint (validate) VCL using flags set for the service.';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'inline_object' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the Fastly generated client parameter `inline_object`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_vcl_lint_vcl_for_service',
  'class' => 'FastlyVclLintVclForService',
  'api_class' => 'VclApi',
  'method_name' => 'lintVclForService',
  'method' => 'POST',
  'path' => '/service/{service_id}/lint',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Lint (validate) VCL using flags set for the service.',
  'description' => 'Lint (validate) VCL using flags set for the service.',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'inline_object' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'JSON request body matching the Fastly generated client parameter `inline_object`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => 'inline_object',
  'body_required' => true,
);
}

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Lint (validate) VCL using a default set of flags.
 *
 * Maps to Fastly generated client operation VclApi::lintVclDefault (POST /vcl_lint).
 */
class FastlyVclLintVclDefault extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_lint_vcl_default';
    protected const DESCRIPTION = 'Lint (validate) VCL using a default set of flags.

Official Fastly client operation: VclApi::lintVclDefault
Endpoint: POST /vcl_lint

Lint (validate) VCL using a default set of flags.';
    protected const PARAMETERS = array (
  'inline_object1' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the Fastly generated client parameter `inline_object1`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_vcl_lint_vcl_default',
  'class' => 'FastlyVclLintVclDefault',
  'api_class' => 'VclApi',
  'method_name' => 'lintVclDefault',
  'method' => 'POST',
  'path' => '/vcl_lint',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Lint (validate) VCL using a default set of flags.',
  'description' => 'Lint (validate) VCL using a default set of flags.',
  'type' => 'write',
  'parameters' =>
  array (
    'inline_object1' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'JSON request body matching the Fastly generated client parameter `inline_object1`.',
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
  'body_param' => 'inline_object1',
  'body_required' => true,
);
}

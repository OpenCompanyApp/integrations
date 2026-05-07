<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create an apex redirect
 *
 * Maps to Fastly generated client operation ApexRedirectApi::createApexRedirect (POST /service/{service_id}/version/{version_id}/apex-redirects).
 */
class FastlyApexRedirectCreateApexRedirect extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apex_redirect_create_apex_redirect';
    protected const DESCRIPTION = 'Create an apex redirect

Official Fastly client operation: ApexRedirectApi::createApexRedirect
Endpoint: POST /service/{service_id}/version/{version_id}/apex-redirects

Create an apex redirect';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `version`.',
  ),
  'created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `created_at`.',
  ),
  'deleted_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `deleted_at`.',
  ),
  'updated_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `updated_at`.',
  ),
  'status_code' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `status_code`.',
  ),
  'domains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `domains`.',
  ),
  'feature_revision' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `feature_revision`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apex_redirect_create_apex_redirect',
  'class' => 'FastlyApexRedirectCreateApexRedirect',
  'api_class' => 'ApexRedirectApi',
  'method_name' => 'createApexRedirect',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/apex-redirects',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create an apex redirect',
  'description' => 'Create an apex redirect',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
    'version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `version`.',
    ),
    'created_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `created_at`.',
    ),
    'deleted_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `deleted_at`.',
    ),
    'updated_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `updated_at`.',
    ),
    'status_code' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `status_code`.',
    ),
    'domains' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `domains`.',
    ),
    'feature_revision' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `feature_revision`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'service_id' => 'service_id',
    'version' => 'version',
    'created_at' => 'created_at',
    'deleted_at' => 'deleted_at',
    'updated_at' => 'updated_at',
    'status_code' => 'status_code',
    'domains' => 'domains',
    'feature_revision' => 'feature_revision',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

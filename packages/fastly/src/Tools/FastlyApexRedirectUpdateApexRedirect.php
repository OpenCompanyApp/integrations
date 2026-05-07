<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an apex redirect
 *
 * Maps to Fastly generated client operation ApexRedirectApi::updateApexRedirect (PUT /apex-redirects/{apex_redirect_id}).
 */
class FastlyApexRedirectUpdateApexRedirect extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apex_redirect_update_apex_redirect';
    protected const DESCRIPTION = 'Update an apex redirect

Official Fastly client operation: ApexRedirectApi::updateApexRedirect
Endpoint: PUT /apex-redirects/{apex_redirect_id}

Update an apex redirect';
    protected const PARAMETERS = array (
  'apex_redirect_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `apex_redirect_id`.',
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `service_id`.',
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
  'slug' => 'fastly_apex_redirect_update_apex_redirect',
  'class' => 'FastlyApexRedirectUpdateApexRedirect',
  'api_class' => 'ApexRedirectApi',
  'method_name' => 'updateApexRedirect',
  'method' => 'PUT',
  'path' => '/apex-redirects/{apex_redirect_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an apex redirect',
  'description' => 'Update an apex redirect',
  'type' => 'write',
  'parameters' =>
  array (
    'apex_redirect_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `apex_redirect_id`.',
    ),
    'service_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `service_id`.',
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
    'apex_redirect_id' => 'apex_redirect_id',
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

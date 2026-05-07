<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a domain
 *
 * Maps to Fastly generated client operation DomainApi::updateDomain (PUT /service/{service_id}/version/{version_id}/domain/{domain_name}).
 */
class FastlyDomainUpdateDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_update_domain';
    protected const DESCRIPTION = 'Update a domain

Official Fastly client operation: DomainApi::updateDomain
Endpoint: PUT /service/{service_id}/version/{version_id}/domain/{domain_name}

Update a domain';
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
  'domain_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `domain_name`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_update_domain',
  'class' => 'FastlyDomainUpdateDomain',
  'api_class' => 'DomainApi',
  'method_name' => 'updateDomain',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/domain/{domain_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a domain',
  'description' => 'Update a domain',
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
    'domain_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `domain_name`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'domain_name' => 'domain_name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'comment' => 'comment',
    'name' => 'name',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

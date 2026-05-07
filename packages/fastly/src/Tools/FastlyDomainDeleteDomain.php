<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Remove a domain from a service
 *
 * Maps to Fastly generated client operation DomainApi::deleteDomain (DELETE /service/{service_id}/version/{version_id}/domain/{domain_name}).
 */
class FastlyDomainDeleteDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_delete_domain';
    protected const DESCRIPTION = 'Remove a domain from a service

Official Fastly client operation: DomainApi::deleteDomain
Endpoint: DELETE /service/{service_id}/version/{version_id}/domain/{domain_name}

Remove a domain from a service';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_delete_domain',
  'class' => 'FastlyDomainDeleteDomain',
  'api_class' => 'DomainApi',
  'method_name' => 'deleteDomain',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/domain/{domain_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Remove a domain from a service',
  'description' => 'Remove a domain from a service',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

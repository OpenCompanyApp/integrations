<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Describe a domain
 *
 * Maps to Fastly generated client operation DomainApi::getDomain (GET /service/{service_id}/version/{version_id}/domain/{domain_name}).
 */
class FastlyDomainGetDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_get_domain';
    protected const DESCRIPTION = 'Describe a domain

Official Fastly client operation: DomainApi::getDomain
Endpoint: GET /service/{service_id}/version/{version_id}/domain/{domain_name}

Describe a domain';
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
  'slug' => 'fastly_domain_get_domain',
  'class' => 'FastlyDomainGetDomain',
  'api_class' => 'DomainApi',
  'method_name' => 'getDomain',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/domain/{domain_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Describe a domain',
  'description' => 'Describe a domain',
  'type' => 'read',
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

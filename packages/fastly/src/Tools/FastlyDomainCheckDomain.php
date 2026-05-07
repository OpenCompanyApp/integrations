<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Validate DNS configuration for a single domain on a service
 *
 * Maps to Fastly generated client operation DomainApi::checkDomain (GET /service/{service_id}/version/{version_id}/domain/{domain_name}/check).
 */
class FastlyDomainCheckDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_check_domain';
    protected const DESCRIPTION = 'Validate DNS configuration for a single domain on a service

Official Fastly client operation: DomainApi::checkDomain
Endpoint: GET /service/{service_id}/version/{version_id}/domain/{domain_name}/check

Validate DNS configuration for a single domain on a service';
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
  'slug' => 'fastly_domain_check_domain',
  'class' => 'FastlyDomainCheckDomain',
  'api_class' => 'DomainApi',
  'method_name' => 'checkDomain',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/domain/{domain_name}/check',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Validate DNS configuration for a single domain on a service',
  'description' => 'Validate DNS configuration for a single domain on a service',
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

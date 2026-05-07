<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Validate DNS configuration for all domains on a service
 *
 * Maps to Fastly generated client operation DomainApi::checkDomains (GET /service/{service_id}/version/{version_id}/domain/check_all).
 */
class FastlyDomainCheckDomains extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_check_domains';
    protected const DESCRIPTION = 'Validate DNS configuration for all domains on a service

Official Fastly client operation: DomainApi::checkDomains
Endpoint: GET /service/{service_id}/version/{version_id}/domain/check_all

Validate DNS configuration for all domains on a service';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_check_domains',
  'class' => 'FastlyDomainCheckDomains',
  'api_class' => 'DomainApi',
  'method_name' => 'checkDomains',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/domain/check_all',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Validate DNS configuration for all domains on a service',
  'description' => 'Validate DNS configuration for all domains on a service',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

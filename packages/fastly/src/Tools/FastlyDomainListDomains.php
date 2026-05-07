<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List domains
 *
 * Maps to Fastly generated client operation DomainApi::listDomains (GET /service/{service_id}/version/{version_id}/domain).
 */
class FastlyDomainListDomains extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_list_domains';
    protected const DESCRIPTION = 'List domains

Official Fastly client operation: DomainApi::listDomains
Endpoint: GET /service/{service_id}/version/{version_id}/domain

List domains';
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
  'slug' => 'fastly_domain_list_domains',
  'class' => 'FastlyDomainListDomains',
  'api_class' => 'DomainApi',
  'method_name' => 'listDomains',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/domain',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List domains',
  'description' => 'List domains',
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

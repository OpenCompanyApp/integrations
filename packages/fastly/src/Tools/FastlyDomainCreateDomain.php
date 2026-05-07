<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Add a domain name to a service
 *
 * Maps to Fastly generated client operation DomainApi::createDomain (POST /service/{service_id}/version/{version_id}/domain).
 */
class FastlyDomainCreateDomain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_create_domain';
    protected const DESCRIPTION = 'Add a domain name to a service

Official Fastly client operation: DomainApi::createDomain
Endpoint: POST /service/{service_id}/version/{version_id}/domain

Add a domain name to a service';
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
  'slug' => 'fastly_domain_create_domain',
  'class' => 'FastlyDomainCreateDomain',
  'api_class' => 'DomainApi',
  'method_name' => 'createDomain',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/domain',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Add a domain name to a service',
  'description' => 'Add a domain name to a service',
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

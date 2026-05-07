<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Domain status
 *
 * Maps to Fastly generated client operation DomainResearchApi::domainStatus (GET /domain-management/v1/tools/status).
 */
class FastlyDomainResearchDomainStatus extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_research_domain_status';
    protected const DESCRIPTION = 'Domain status

Official Fastly client operation: DomainResearchApi::domainStatus
Endpoint: GET /domain-management/v1/tools/status

Domain status';
    protected const PARAMETERS = array (
  'domain' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `domain`.',
  ),
  'scope' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `scope`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_research_domain_status',
  'class' => 'FastlyDomainResearchDomainStatus',
  'api_class' => 'DomainResearchApi',
  'method_name' => 'domainStatus',
  'method' => 'GET',
  'path' => '/domain-management/v1/tools/status',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Domain status',
  'description' => 'Domain status',
  'type' => 'read',
  'parameters' =>
  array (
    'domain' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `domain`.',
    ),
    'scope' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `scope`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'domain' => 'domain',
    'scope' => 'scope',
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

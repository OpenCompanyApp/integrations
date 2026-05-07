<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Suggest domains
 *
 * Maps to Fastly generated client operation DomainResearchApi::suggestDomains (GET /domain-management/v1/tools/suggest).
 */
class FastlyDomainResearchSuggestDomains extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_research_suggest_domains';
    protected const DESCRIPTION = 'Suggest domains

Official Fastly client operation: DomainResearchApi::suggestDomains
Endpoint: GET /domain-management/v1/tools/suggest

Suggest domains';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `query`.',
  ),
  'defaults' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `defaults`.',
  ),
  'keywords' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `keywords`.',
  ),
  'location' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `location`.',
  ),
  'vendor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `vendor`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_research_suggest_domains',
  'class' => 'FastlyDomainResearchSuggestDomains',
  'api_class' => 'DomainResearchApi',
  'method_name' => 'suggestDomains',
  'method' => 'GET',
  'path' => '/domain-management/v1/tools/suggest',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Suggest domains',
  'description' => 'Suggest domains',
  'type' => 'read',
  'parameters' =>
  array (
    'query' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `query`.',
    ),
    'defaults' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `defaults`.',
    ),
    'keywords' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `keywords`.',
    ),
    'location' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `location`.',
    ),
    'vendor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `vendor`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'query' => 'query',
    'defaults' => 'defaults',
    'keywords' => 'keywords',
    'location' => 'location',
    'vendor' => 'vendor',
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

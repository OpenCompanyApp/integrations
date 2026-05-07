<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get product enablement status
 *
 * Maps to Fastly generated client operation ProductDomainResearchApi::getDomainResearch (GET /enabled-products/v1/domain_research).
 */
class FastlyProductDomainResearchGetDomainResearch extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_domain_research_get_domain_research';
    protected const DESCRIPTION = 'Get product enablement status

Official Fastly client operation: ProductDomainResearchApi::getDomainResearch
Endpoint: GET /enabled-products/v1/domain_research

Get product enablement status';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_domain_research_get_domain_research',
  'class' => 'FastlyProductDomainResearchGetDomainResearch',
  'api_class' => 'ProductDomainResearchApi',
  'method_name' => 'getDomainResearch',
  'method' => 'GET',
  'path' => '/enabled-products/v1/domain_research',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get product enablement status',
  'description' => 'Get product enablement status',
  'type' => 'read',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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

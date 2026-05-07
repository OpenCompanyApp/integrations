<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable product
 *
 * Maps to Fastly generated client operation ProductDomainResearchApi::enableDomainResearch (PUT /enabled-products/v1/domain_research).
 */
class FastlyProductDomainResearchEnableDomainResearch extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_domain_research_enable_domain_research';
    protected const DESCRIPTION = 'Enable product

Official Fastly client operation: ProductDomainResearchApi::enableDomainResearch
Endpoint: PUT /enabled-products/v1/domain_research

Enable product';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_domain_research_enable_domain_research',
  'class' => 'FastlyProductDomainResearchEnableDomainResearch',
  'api_class' => 'ProductDomainResearchApi',
  'method_name' => 'enableDomainResearch',
  'method' => 'PUT',
  'path' => '/enabled-products/v1/domain_research',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Enable product',
  'description' => 'Enable product',
  'type' => 'write',
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

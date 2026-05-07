<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Disable product
 *
 * Maps to Fastly generated client operation ProductDomainResearchApi::disableProductDomainResearch (DELETE /enabled-products/v1/domain_research).
 */
class FastlyProductDomainResearchDisableProductDomainResearch extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_domain_research_disable_product_domain_research';
    protected const DESCRIPTION = 'Disable product

Official Fastly client operation: ProductDomainResearchApi::disableProductDomainResearch
Endpoint: DELETE /enabled-products/v1/domain_research

Disable product';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_domain_research_disable_product_domain_research',
  'class' => 'FastlyProductDomainResearchDisableProductDomainResearch',
  'api_class' => 'ProductDomainResearchApi',
  'method_name' => 'disableProductDomainResearch',
  'method' => 'DELETE',
  'path' => '/enabled-products/v1/domain_research',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Disable product',
  'description' => 'Disable product',
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

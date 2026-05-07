<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductDomainInspectorApi::getServicesProductDomainInspector (GET /enabled-products/v1/domain_inspector/services).
 */
class FastlyProductDomainInspectorGetServicesProductDomainInspector extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_domain_inspector_get_services_product_domain_inspector';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductDomainInspectorApi::getServicesProductDomainInspector
Endpoint: GET /enabled-products/v1/domain_inspector/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_domain_inspector_get_services_product_domain_inspector',
  'class' => 'FastlyProductDomainInspectorGetServicesProductDomainInspector',
  'api_class' => 'ProductDomainInspectorApi',
  'method_name' => 'getServicesProductDomainInspector',
  'method' => 'GET',
  'path' => '/enabled-products/v1/domain_inspector/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get services with product enabled',
  'description' => 'Get services with product enabled',
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

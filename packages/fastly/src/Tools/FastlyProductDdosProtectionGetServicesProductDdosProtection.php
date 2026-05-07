<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductDdosProtectionApi::getServicesProductDdosProtection (GET /enabled-products/v1/ddos_protection/services).
 */
class FastlyProductDdosProtectionGetServicesProductDdosProtection extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_ddos_protection_get_services_product_ddos_protection';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductDdosProtectionApi::getServicesProductDdosProtection
Endpoint: GET /enabled-products/v1/ddos_protection/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_ddos_protection_get_services_product_ddos_protection',
  'class' => 'FastlyProductDdosProtectionGetServicesProductDdosProtection',
  'api_class' => 'ProductDdosProtectionApi',
  'method_name' => 'getServicesProductDdosProtection',
  'method' => 'GET',
  'path' => '/enabled-products/v1/ddos_protection/services',
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

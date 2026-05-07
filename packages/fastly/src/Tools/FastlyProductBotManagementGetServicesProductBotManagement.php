<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductBotManagementApi::getServicesProductBotManagement (GET /enabled-products/v1/bot_management/services).
 */
class FastlyProductBotManagementGetServicesProductBotManagement extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_bot_management_get_services_product_bot_management';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductBotManagementApi::getServicesProductBotManagement
Endpoint: GET /enabled-products/v1/bot_management/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_bot_management_get_services_product_bot_management',
  'class' => 'FastlyProductBotManagementGetServicesProductBotManagement',
  'api_class' => 'ProductBotManagementApi',
  'method_name' => 'getServicesProductBotManagement',
  'method' => 'GET',
  'path' => '/enabled-products/v1/bot_management/services',
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

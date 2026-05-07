<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a customer
 *
 * Maps to Fastly generated client operation CustomerApi::getCustomer (GET /customer/{customer_id}).
 */
class FastlyCustomerGetCustomer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_get_customer';
    protected const DESCRIPTION = 'Get a customer

Official Fastly client operation: CustomerApi::getCustomer
Endpoint: GET /customer/{customer_id}

Get a customer';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_customer_get_customer',
  'class' => 'FastlyCustomerGetCustomer',
  'api_class' => 'CustomerApi',
  'method_name' => 'getCustomer',
  'method' => 'GET',
  'path' => '/customer/{customer_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a customer',
  'description' => 'Get a customer',
  'type' => 'read',
  'parameters' =>
  array (
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `customer_id`.',
    ),
  ),
  'path_params' =>
  array (
    'customer_id' => 'customer_id',
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

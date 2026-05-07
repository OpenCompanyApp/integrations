<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a customer
 *
 * Maps to Fastly generated client operation CustomerApi::deleteCustomer (DELETE /customer/{customer_id}).
 */
class FastlyCustomerDeleteCustomer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_delete_customer';
    protected const DESCRIPTION = 'Delete a customer

Official Fastly client operation: CustomerApi::deleteCustomer
Endpoint: DELETE /customer/{customer_id}

Delete a customer';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_customer_delete_customer',
  'class' => 'FastlyCustomerDeleteCustomer',
  'api_class' => 'CustomerApi',
  'method_name' => 'deleteCustomer',
  'method' => 'DELETE',
  'path' => '/customer/{customer_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a customer',
  'description' => 'Delete a customer',
  'type' => 'write',
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

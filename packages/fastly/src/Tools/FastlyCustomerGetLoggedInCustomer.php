<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get the logged in customer
 *
 * Maps to Fastly generated client operation CustomerApi::getLoggedInCustomer (GET /current_customer).
 */
class FastlyCustomerGetLoggedInCustomer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_get_logged_in_customer';
    protected const DESCRIPTION = 'Get the logged in customer

Official Fastly client operation: CustomerApi::getLoggedInCustomer
Endpoint: GET /current_customer

Get the logged in customer';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_customer_get_logged_in_customer',
  'class' => 'FastlyCustomerGetLoggedInCustomer',
  'api_class' => 'CustomerApi',
  'method_name' => 'getLoggedInCustomer',
  'method' => 'GET',
  'path' => '/current_customer',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get the logged in customer',
  'description' => 'Get the logged in customer',
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

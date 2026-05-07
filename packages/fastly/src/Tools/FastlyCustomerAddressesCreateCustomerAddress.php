<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Creates an address associated with a customer account.
 *
 * Maps to Fastly generated client operation CustomerAddressesApi::createCustomerAddress (POST /billing/v3/customer-addresses).
 */
class FastlyCustomerAddressesCreateCustomerAddress extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_addresses_create_customer_address';
    protected const DESCRIPTION = 'Creates an address associated with a customer account.

Official Fastly client operation: CustomerAddressesApi::createCustomerAddress
Endpoint: POST /billing/v3/customer-addresses

Creates an address associated with a customer account.';
    protected const PARAMETERS = array (
  'customer_address' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the Fastly generated client parameter `customer_address`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_customer_addresses_create_customer_address',
  'class' => 'FastlyCustomerAddressesCreateCustomerAddress',
  'api_class' => 'CustomerAddressesApi',
  'method_name' => 'createCustomerAddress',
  'method' => 'POST',
  'path' => '/billing/v3/customer-addresses',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Creates an address associated with a customer account.',
  'description' => 'Creates an address associated with a customer account.',
  'type' => 'write',
  'parameters' =>
  array (
    'customer_address' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'JSON request body matching the Fastly generated client parameter `customer_address`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
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
  'body_param' => 'customer_address',
  'body_required' => true,
);
}

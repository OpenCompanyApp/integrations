<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Updates an address associated with a customer account.
 *
 * Maps to Fastly generated client operation CustomerAddressesApi::updateCustomerAddress (PUT /billing/v3/customer-addresses/{type}).
 */
class FastlyCustomerAddressesUpdateCustomerAddress extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_addresses_update_customer_address';
    protected const DESCRIPTION = 'Updates an address associated with a customer account.

Official Fastly client operation: CustomerAddressesApi::updateCustomerAddress
Endpoint: PUT /billing/v3/customer-addresses/{type}

Updates an address associated with a customer account.';
    protected const PARAMETERS = array (
  'type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `type`.',
  ),
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
  'slug' => 'fastly_customer_addresses_update_customer_address',
  'class' => 'FastlyCustomerAddressesUpdateCustomerAddress',
  'api_class' => 'CustomerAddressesApi',
  'method_name' => 'updateCustomerAddress',
  'method' => 'PUT',
  'path' => '/billing/v3/customer-addresses/{type}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Updates an address associated with a customer account.',
  'description' => 'Updates an address associated with a customer account.',
  'type' => 'write',
  'parameters' =>
  array (
    'type' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `type`.',
    ),
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
    'type' => 'type',
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

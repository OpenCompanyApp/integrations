<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Add a billing address to a customer
 *
 * Maps to Fastly generated client operation BillingAddressApi::addBillingAddr (POST /customer/{customer_id}/billing_address).
 */
class FastlyBillingAddressAddBillingAddr extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_address_add_billing_addr';
    protected const DESCRIPTION = 'Add a billing address to a customer

Official Fastly client operation: BillingAddressApi::addBillingAddr
Endpoint: POST /customer/{customer_id}/billing_address

Add a billing address to a customer';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
  'billing_address_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `billing_address_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_address_add_billing_addr',
  'class' => 'FastlyBillingAddressAddBillingAddr',
  'api_class' => 'BillingAddressApi',
  'method_name' => 'addBillingAddr',
  'method' => 'POST',
  'path' => '/customer/{customer_id}/billing_address',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Add a billing address to a customer',
  'description' => 'Add a billing address to a customer',
  'type' => 'write',
  'parameters' =>
  array (
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `customer_id`.',
    ),
    'billing_address_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `billing_address_request`.',
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
  'body_param' => 'billing_address_request',
  'body_required' => false,
);
}

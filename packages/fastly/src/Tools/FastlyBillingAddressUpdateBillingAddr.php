<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a billing address
 *
 * Maps to Fastly generated client operation BillingAddressApi::updateBillingAddr (PATCH /customer/{customer_id}/billing_address).
 */
class FastlyBillingAddressUpdateBillingAddr extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_address_update_billing_addr';
    protected const DESCRIPTION = 'Update a billing address

Official Fastly client operation: BillingAddressApi::updateBillingAddr
Endpoint: PATCH /customer/{customer_id}/billing_address

Update a billing address';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
  'update_billing_address_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `update_billing_address_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_address_update_billing_addr',
  'class' => 'FastlyBillingAddressUpdateBillingAddr',
  'api_class' => 'BillingAddressApi',
  'method_name' => 'updateBillingAddr',
  'method' => 'PATCH',
  'path' => '/customer/{customer_id}/billing_address',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a billing address',
  'description' => 'Update a billing address',
  'type' => 'write',
  'parameters' =>
  array (
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `customer_id`.',
    ),
    'update_billing_address_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `update_billing_address_request`.',
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
  'body_param' => 'update_billing_address_request',
  'body_required' => false,
);
}

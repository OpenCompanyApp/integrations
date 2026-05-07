<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a billing address
 *
 * Maps to Fastly generated client operation BillingAddressApi::deleteBillingAddr (DELETE /customer/{customer_id}/billing_address).
 */
class FastlyBillingAddressDeleteBillingAddr extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_address_delete_billing_addr';
    protected const DESCRIPTION = 'Delete a billing address

Official Fastly client operation: BillingAddressApi::deleteBillingAddr
Endpoint: DELETE /customer/{customer_id}/billing_address

Delete a billing address';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_address_delete_billing_addr',
  'class' => 'FastlyBillingAddressDeleteBillingAddr',
  'api_class' => 'BillingAddressApi',
  'method_name' => 'deleteBillingAddr',
  'method' => 'DELETE',
  'path' => '/customer/{customer_id}/billing_address',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a billing address',
  'description' => 'Delete a billing address',
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

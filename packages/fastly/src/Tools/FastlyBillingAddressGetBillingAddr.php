<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a billing address
 *
 * Maps to Fastly generated client operation BillingAddressApi::getBillingAddr (GET /customer/{customer_id}/billing_address).
 */
class FastlyBillingAddressGetBillingAddr extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_address_get_billing_addr';
    protected const DESCRIPTION = 'Get a billing address

Official Fastly client operation: BillingAddressApi::getBillingAddr
Endpoint: GET /customer/{customer_id}/billing_address

Get a billing address';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_address_get_billing_addr',
  'class' => 'FastlyBillingAddressGetBillingAddr',
  'api_class' => 'BillingAddressApi',
  'method_name' => 'getBillingAddr',
  'method' => 'GET',
  'path' => '/customer/{customer_id}/billing_address',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a billing address',
  'description' => 'Get a billing address',
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

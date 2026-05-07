<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Return the list of addresses associated with a customer account.
 *
 * Maps to Fastly generated client operation CustomerAddressesApi::listCustomerAddresses (GET /billing/v3/customer-addresses).
 */
class FastlyCustomerAddressesListCustomerAddresses extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_addresses_list_customer_addresses';
    protected const DESCRIPTION = 'Return the list of addresses associated with a customer account.

Official Fastly client operation: CustomerAddressesApi::listCustomerAddresses
Endpoint: GET /billing/v3/customer-addresses

Return the list of addresses associated with a customer account.';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_customer_addresses_list_customer_addresses',
  'class' => 'FastlyCustomerAddressesListCustomerAddresses',
  'api_class' => 'CustomerAddressesApi',
  'method_name' => 'listCustomerAddresses',
  'method' => 'GET',
  'path' => '/billing/v3/customer-addresses',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Return the list of addresses associated with a customer account.',
  'description' => 'Return the list of addresses associated with a customer account.',
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

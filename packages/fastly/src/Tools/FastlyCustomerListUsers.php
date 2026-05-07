<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List users
 *
 * Maps to Fastly generated client operation CustomerApi::listUsers (GET /customer/{customer_id}/users).
 */
class FastlyCustomerListUsers extends AbstractFastlyTool
{
    protected const NAME = 'fastly_customer_list_users';
    protected const DESCRIPTION = 'List users

Official Fastly client operation: CustomerApi::listUsers
Endpoint: GET /customer/{customer_id}/users

List users';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_customer_list_users',
  'class' => 'FastlyCustomerListUsers',
  'api_class' => 'CustomerApi',
  'method_name' => 'listUsers',
  'method' => 'GET',
  'path' => '/customer/{customer_id}/users',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List users',
  'description' => 'List users',
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

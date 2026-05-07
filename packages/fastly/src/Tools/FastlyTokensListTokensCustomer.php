<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List tokens for a customer
 *
 * Maps to Fastly generated client operation TokensApi::listTokensCustomer (GET /customer/{customer_id}/tokens).
 */
class FastlyTokensListTokensCustomer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_list_tokens_customer';
    protected const DESCRIPTION = 'List tokens for a customer

Official Fastly client operation: TokensApi::listTokensCustomer
Endpoint: GET /customer/{customer_id}/tokens

List tokens for a customer';
    protected const PARAMETERS = array (
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_list_tokens_customer',
  'class' => 'FastlyTokensListTokensCustomer',
  'api_class' => 'TokensApi',
  'method_name' => 'listTokensCustomer',
  'method' => 'GET',
  'path' => '/customer/{customer_id}/tokens',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List tokens for a customer',
  'description' => 'List tokens for a customer',
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

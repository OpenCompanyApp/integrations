<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Lists vendors.
 *
 * Maps to the official Brex endpoint get /v1/vendors.
 */
class BrexPaymentsListVendors extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_list_vendors';
    protected const DESCRIPTION = 'Lists vendors

Official Brex endpoint: GET /v1/vendors

This endpoint lists all existing vendors for an account. Takes an optional parameter to match by vendor name.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/vendors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

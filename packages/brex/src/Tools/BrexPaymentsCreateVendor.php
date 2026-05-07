<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create vendor.
 *
 * Maps to the official Brex endpoint post /v1/vendors.
 */
class BrexPaymentsCreateVendor extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_create_vendor';
    protected const DESCRIPTION = 'Create vendor

Official Brex endpoint: POST /v1/vendors

This endpoint creates a new vendor.';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/vendors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}

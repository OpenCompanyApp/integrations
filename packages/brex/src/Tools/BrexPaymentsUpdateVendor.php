<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Update vendor.
 *
 * Maps to the official Brex endpoint put /v1/vendors/{id}.
 */
class BrexPaymentsUpdateVendor extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_update_vendor';
    protected const DESCRIPTION = 'Update vendor

Official Brex endpoint: PUT /v1/vendors/{id}

Updates an existing vendor by ID.';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/vendors/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}

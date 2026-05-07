<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get vendor.
 *
 * Maps to the official Brex endpoint get /v1/vendors/{id}.
 */
class BrexPaymentsGetVendorById extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_get_vendor_by_id';
    protected const DESCRIPTION = 'Get vendor

Official Brex endpoint: GET /v1/vendors/{id}

This endpoint gets a vendor by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/vendors/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

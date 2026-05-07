<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Delete vendor..
 *
 * Maps to the official Brex endpoint delete /v1/vendors/{id}.
 */
class BrexPaymentsDeleteVendor extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_delete_vendor';
    protected const DESCRIPTION = 'Delete vendor.

Official Brex endpoint: DELETE /v1/vendors/{id}

This endpoint deletes a vendor by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'delete';
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

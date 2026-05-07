<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get transfer.
 *
 * Maps to the official Brex endpoint get /v1/transfers/{id}.
 */
class BrexPaymentsGetTransfersById extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_get_transfers_by_id';
    protected const DESCRIPTION = 'Get transfer

Official Brex endpoint: GET /v1/transfers/{id}

This endpoint gets a transfer by ID. Currently, the API can only return transfers for the following payment rails: - ACH - DOMESTIC_WIRE - CHEQUE - INTERNATIONAL_WIRE';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/transfers/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

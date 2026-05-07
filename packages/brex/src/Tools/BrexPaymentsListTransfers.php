<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Lists transfers.
 *
 * Maps to the official Brex endpoint get /v1/transfers.
 */
class BrexPaymentsListTransfers extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_list_transfers';
    protected const DESCRIPTION = 'Lists transfers

Official Brex endpoint: GET /v1/transfers

This endpoint lists existing transfers for an account. Currently, the API can only return transfers for the following payment rails: - ACH - DOMESTIC_WIRE - CHEQUE - INTERNATIONAL_WIRE';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/transfers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

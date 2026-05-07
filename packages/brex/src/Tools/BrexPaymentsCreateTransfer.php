<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create transfer.
 *
 * Maps to the official Brex endpoint post /v1/transfers.
 */
class BrexPaymentsCreateTransfer extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_create_transfer';
    protected const DESCRIPTION = 'Create transfer

Official Brex endpoint: POST /v1/transfers

This endpoint creates a new transfer. Currently, the API can only create transfers for the following payment rails: - ACH - DOMESTIC_WIRE - CHEQUE - INTERNATIONAL_WIRES **Transaction Descriptions** * For outgoing check payments, a successful transfer will return a response containing a description value with a format of `Check # to - `. * For book transfers (from one Brex Business account to another), the recipient value will have a format of ` - ` and the sender will have a format of `';
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
    protected const PATH = '/v1/transfers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}

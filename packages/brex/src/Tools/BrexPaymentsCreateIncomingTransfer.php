<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create incoming transfer.
 *
 * Maps to the official Brex endpoint post /v1/incoming_transfers.
 */
class BrexPaymentsCreateIncomingTransfer extends AbstractBrexTool
{
    protected const NAME = 'brex_payments_create_incoming_transfer';
    protected const DESCRIPTION = 'Create incoming transfer

Official Brex endpoint: POST /v1/incoming_transfers

This endpoint creates a new incoming transfer. You may use use any eligible bank account connection to fund (ACH Debit) any active Brex business account. **Reminder**: You may not use the Brex API for any activity that requires a license or registration from any governmental authority without Brex\'s prior review and approval. This includes but is not limited to any money services business or money transmission activity. Please review the Brex Access Agreement and contact us if you have any questions.';
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
    protected const PATH = '/v1/incoming_transfers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}

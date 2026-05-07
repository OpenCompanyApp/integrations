<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List receipts.
 *
 * Maps to the official Ramp endpoint get /developer/v1/receipts.
 */
class RampGetReceiptList extends AbstractRampTool
{
    protected const NAME = 'ramp_get_receipt_list';
    protected const DESCRIPTION = 'List receipts

Official Ramp endpoint: GET /developer/v1/receipts';
    protected const PARAMETERS = array (
  'created_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_after` from the official Ramp API operation.',
  ),
  'created_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_before` from the official Ramp API operation.',
  ),
  'reimbursement_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reimbursement_id` from the official Ramp API operation.',
  ),
  'transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `transaction_id` from the official Ramp API operation.',
  ),
  'from_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_date` from the official Ramp API operation.',
  ),
  'to_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_date` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/receipts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'created_after' => 'created_after',
  'created_before' => 'created_before',
  'reimbursement_id' => 'reimbursement_id',
  'transaction_id' => 'transaction_id',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

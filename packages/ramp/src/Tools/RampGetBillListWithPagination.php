<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List bills.
 *
 * Maps to the official Ramp endpoint get /developer/v1/bills.
 */
class RampGetBillListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_bill_list_with_pagination';
    protected const DESCRIPTION = 'List bills

Official Ramp endpoint: GET /developer/v1/bills';
    protected const PARAMETERS = array (
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'customer_friendly_payment_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `customer_friendly_payment_id` from the official Ramp API operation.',
  ),
  'draft_bill_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `draft_bill_id` from the official Ramp API operation.',
  ),
  'invoice_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `invoice_number` from the official Ramp API operation.',
  ),
  'remote_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `remote_id` from the official Ramp API operation.',
  ),
  'accounting_field_selection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_field_selection_id` from the official Ramp API operation.',
  ),
  'status_summaries' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `status_summaries` from the official Ramp API operation.',
  ),
  'payment_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_id` from the official Ramp API operation.',
  ),
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `vendor_id` from the official Ramp API operation.',
  ),
  'is_accounting_sync_enabled' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_accounting_sync_enabled` from the official Ramp API operation.',
  ),
  'approval_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `approval_status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'APPROVED',
      1 => 'INITIALIZED',
      2 => 'PENDING',
      3 => 'REJECTED',
      4 => 'TERMINATED',
    ),
  ),
  'payment_method' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_method` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'ACH',
      1 => 'CARD',
      2 => 'CHECK',
      3 => 'DOMESTIC_WIRE',
      4 => 'INTERNATIONAL',
      5 => 'LOCAL_BANK_TRANSFER',
      6 => 'ONE_TIME_CARD',
      7 => 'ONE_TIME_CARD_DELIVERY',
      8 => 'PAID_MANUALLY',
      9 => 'SWIFT',
    ),
  ),
  'payment_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'OPEN',
      1 => 'PAID',
    ),
  ),
  'sync_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sync_status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'BILL_AND_PAYMENT_SYNCED',
      1 => 'BILL_SYNCED',
      2 => 'NOT_SYNCED',
    ),
  ),
  'sync_ready' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `sync_ready` from the official Ramp API operation.',
  ),
  'payment_details_missing' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `payment_details_missing` from the official Ramp API operation.',
  ),
  'is_archived' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_archived` from the official Ramp API operation.',
  ),
  'from_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_created_at` from the official Ramp API operation.',
  ),
  'to_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_created_at` from the official Ramp API operation.',
  ),
  'from_due_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_due_date` from the official Ramp API operation.',
  ),
  'to_due_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_due_date` from the official Ramp API operation.',
  ),
  'from_issued_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_issued_date` from the official Ramp API operation.',
  ),
  'to_issued_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_issued_date` from the official Ramp API operation.',
  ),
  'from_paid_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_paid_at` from the official Ramp API operation.',
  ),
  'to_paid_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_paid_at` from the official Ramp API operation.',
  ),
  'from_payment_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_payment_date` from the official Ramp API operation.',
  ),
  'to_payment_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_payment_date` from the official Ramp API operation.',
  ),
  'min_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `min_amount` from the official Ramp API operation.',
  ),
  'max_amount' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `max_amount` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/bills';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'entity_id' => 'entity_id',
  'customer_friendly_payment_id' => 'customer_friendly_payment_id',
  'draft_bill_id' => 'draft_bill_id',
  'invoice_number' => 'invoice_number',
  'remote_id' => 'remote_id',
  'accounting_field_selection_id' => 'accounting_field_selection_id',
  'status_summaries' => 'status_summaries',
  'payment_id' => 'payment_id',
  'vendor_id' => 'vendor_id',
  'is_accounting_sync_enabled' => 'is_accounting_sync_enabled',
  'approval_status' => 'approval_status',
  'payment_method' => 'payment_method',
  'payment_status' => 'payment_status',
  'sync_status' => 'sync_status',
  'sync_ready' => 'sync_ready',
  'payment_details_missing' => 'payment_details_missing',
  'is_archived' => 'is_archived',
  'from_created_at' => 'from_created_at',
  'to_created_at' => 'to_created_at',
  'from_due_date' => 'from_due_date',
  'to_due_date' => 'to_due_date',
  'from_issued_date' => 'from_issued_date',
  'to_issued_date' => 'to_issued_date',
  'from_paid_at' => 'from_paid_at',
  'to_paid_at' => 'to_paid_at',
  'from_payment_date' => 'from_payment_date',
  'to_payment_date' => 'to_payment_date',
  'min_amount' => 'min_amount',
  'max_amount' => 'max_amount',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List reimbursements.
 *
 * Maps to the official Ramp endpoint get /developer/v1/reimbursements.
 */
class RampGetReimbursementListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_reimbursement_list_with_pagination';
    protected const DESCRIPTION = 'List reimbursements

Official Ramp endpoint: GET /developer/v1/reimbursements';
    protected const PARAMETERS = array (
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `direction` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'BUSINESS_TO_USER',
      1 => 'USER_TO_BUSINESS',
    ),
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `state` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'APPROVED',
      1 => 'AWAITING_EXPORT',
      2 => 'AWAITING_PAYMENT',
      3 => 'AWAITING_PUSH_PAYMENT',
      4 => 'CANCELED',
      5 => 'DELETED',
      6 => 'DRAFT',
      7 => 'EXPORTED',
      8 => 'EXPORT_FAILED',
      9 => 'EXPORT_INITIATED',
      10 => 'EXPORT_MARKED_AS_FAILED',
      11 => 'EXPORT_SUCCESSFUL',
      12 => 'FAILED_REIMBURSEMENT',
      13 => 'INIT',
      14 => 'MANUALLY_REIMBURSED',
      15 => 'MISSING_ACH',
      16 => 'PENDING',
      17 => 'PROCESSING',
      18 => 'PUSH_PAYMENT_FAILED',
      19 => 'PUSH_PAYMENT_INITIATED',
      20 => 'REIMBURSED',
      21 => 'REIMBURSED_VIA_PUSH',
      22 => 'REJECTED',
    ),
  ),
  'sync_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sync_status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'NOT_SYNC_READY',
      1 => 'SYNCED',
      2 => 'SYNC_READY',
    ),
  ),
  'from_transaction_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_transaction_date` from the official Ramp API operation.',
  ),
  'to_transaction_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_transaction_date` from the official Ramp API operation.',
  ),
  'awaiting_approval_by_user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `awaiting_approval_by_user_id` from the official Ramp API operation.',
  ),
  'has_been_approved' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `has_been_approved` from the official Ramp API operation.',
  ),
  'trip_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `trip_id` from the official Ramp API operation.',
  ),
  'accounting_field_selection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_field_selection_id` from the official Ramp API operation.',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
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
  'from_submitted_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_submitted_at` from the official Ramp API operation.',
  ),
  'to_submitted_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_submitted_at` from the official Ramp API operation.',
  ),
  'synced_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `synced_after` from the official Ramp API operation.',
  ),
  'sync_ready' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `sync_ready` from the official Ramp API operation.',
  ),
  'has_no_sync_commits' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `has_no_sync_commits` from the official Ramp API operation.',
  ),
  'updated_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_after` from the official Ramp API operation.',
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
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/reimbursements';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'direction' => 'direction',
  'state' => 'state',
  'sync_status' => 'sync_status',
  'from_transaction_date' => 'from_transaction_date',
  'to_transaction_date' => 'to_transaction_date',
  'awaiting_approval_by_user_id' => 'awaiting_approval_by_user_id',
  'has_been_approved' => 'has_been_approved',
  'trip_id' => 'trip_id',
  'accounting_field_selection_id' => 'accounting_field_selection_id',
  'entity_id' => 'entity_id',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'from_submitted_at' => 'from_submitted_at',
  'to_submitted_at' => 'to_submitted_at',
  'synced_after' => 'synced_after',
  'sync_ready' => 'sync_ready',
  'has_no_sync_commits' => 'has_no_sync_commits',
  'updated_after' => 'updated_after',
  'start' => 'start',
  'page_size' => 'page_size',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

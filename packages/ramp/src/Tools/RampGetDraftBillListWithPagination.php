<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List draft bills.
 *
 * Maps to the official Ramp endpoint get /developer/v1/bills/drafts.
 */
class RampGetDraftBillListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_draft_bill_list_with_pagination';
    protected const DESCRIPTION = 'List draft bills

Official Ramp endpoint: GET /developer/v1/bills/drafts';
    protected const PARAMETERS = array (
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
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
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `vendor_id` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/bills/drafts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'entity_id' => 'entity_id',
  'invoice_number' => 'invoice_number',
  'remote_id' => 'remote_id',
  'vendor_id' => 'vendor_id',
  'from_created_at' => 'from_created_at',
  'to_created_at' => 'to_created_at',
  'from_due_date' => 'from_due_date',
  'to_due_date' => 'to_due_date',
  'from_issued_date' => 'from_issued_date',
  'to_issued_date' => 'to_issued_date',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

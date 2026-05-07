<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List transfer payments.
 *
 * Maps to the official Ramp endpoint get /developer/v1/transfers.
 */
class RampGetTransferListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_transfer_list_with_pagination';
    protected const DESCRIPTION = 'List transfer payments

Official Ramp endpoint: GET /developer/v1/transfers

For information on how to use this endpoint, refer to the [Transfers Guide](/developer-api/v1/guides/transfers).';
    protected const PARAMETERS = array (
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
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'ACH_CONFIRMED',
      1 => 'CANCELED',
      2 => 'COMPLETED',
      3 => 'ERROR',
      4 => 'INITIATED',
      5 => 'NOT_ACKED',
      6 => 'NOT_ENOUGH_FUNDS',
      7 => 'PROCESSING_BY_ODFI',
      8 => 'REJECTED_BY_ODFI',
      9 => 'RETURNED_BY_RDFI',
      10 => 'SUBMITTED_TO_FED',
      11 => 'SUBMITTED_TO_RDFI',
      12 => 'UNNECESSARY',
      13 => 'UPLOADED',
    ),
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'statement_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `statement_id` from the official Ramp API operation.',
  ),
  'has_no_sync_commits' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `has_no_sync_commits` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/transfers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'sync_status' => 'sync_status',
  'status' => 'status',
  'entity_id' => 'entity_id',
  'statement_id' => 'statement_id',
  'has_no_sync_commits' => 'has_no_sync_commits',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

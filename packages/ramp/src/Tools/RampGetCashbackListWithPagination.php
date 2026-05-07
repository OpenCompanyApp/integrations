<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List cashback payments.
 *
 * Maps to the official Ramp endpoint get /developer/v1/cashbacks.
 */
class RampGetCashbackListWithPagination extends AbstractRampTool
{
    protected const NAME = 'ramp_get_cashback_list_with_pagination';
    protected const DESCRIPTION = 'List cashback payments

Official Ramp endpoint: GET /developer/v1/cashbacks';
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
  'sync_ready' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `sync_ready` from the official Ramp API operation.',
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
    protected const PATH = '/developer/v1/cashbacks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'sync_status' => 'sync_status',
  'entity_id' => 'entity_id',
  'statement_id' => 'statement_id',
  'sync_ready' => 'sync_ready',
  'from_date' => 'from_date',
  'to_date' => 'to_date',
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list payment orders.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_orders.
 */
class ModernTreasuryListPaymentOrders extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_payment_orders';
    protected const DESCRIPTION = 'list payment orders

Official Modern Treasury endpoint: GET /api/payment_orders

Get a list of all payment orders';
    protected const PARAMETERS = array (
  'after_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after_cursor` from the official Modern Treasury API operation.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'ach',
      1 => 'au_becs',
      2 => 'bacs',
      3 => 'book',
      4 => 'card',
      5 => 'chats',
      6 => 'check',
      7 => 'cross_border',
      8 => 'dk_nets',
      9 => 'eft',
      10 => 'gb_fps',
      11 => 'hu_ics',
      12 => 'interac',
      13 => 'masav',
      14 => 'mx_ccen',
      15 => 'neft',
      16 => 'nics',
      17 => 'nz_becs',
      18 => 'pl_elixir',
      19 => 'provxchange',
      20 => 'ro_sent',
      21 => 'rtp',
      22 => 'se_bankgirot',
      23 => 'sen',
      24 => 'sepa',
      25 => 'sg_giro',
      26 => 'sic',
      27 => 'signet',
      28 => 'sknbi',
      29 => 'stablecoin',
      30 => 'wire',
      31 => 'zengin',
    ),
  ),
  'priority' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `priority` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'high',
      1 => 'normal',
    ),
  ),
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'originating_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `originating_account_id` from the official Modern Treasury API operation.',
  ),
  'transaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `transaction_id` from the official Modern Treasury API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'approved',
      1 => 'cancelled',
      2 => 'completed',
      3 => 'denied',
      4 => 'failed',
      5 => 'held',
      6 => 'needs_approval',
      7 => 'pending',
      8 => 'processing',
      9 => 'returned',
      10 => 'reversed',
      11 => 'sent',
      12 => 'stopped',
    ),
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `direction` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'credit',
      1 => 'debit',
    ),
  ),
  'reference_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reference_number` from the official Modern Treasury API operation.',
  ),
  'effective_date_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `effective_date_start` from the official Modern Treasury API operation.',
  ),
  'effective_date_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `effective_date_end` from the official Modern Treasury API operation.',
  ),
  'created_at_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_start` from the official Modern Treasury API operation.',
  ),
  'created_at_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_end` from the official Modern Treasury API operation.',
  ),
  'process_after_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `process_after_start` from the official Modern Treasury API operation.',
  ),
  'process_after_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `process_after_end` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/payment_orders';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'type' => 'type',
  'priority' => 'priority',
  'counterparty_id' => 'counterparty_id',
  'originating_account_id' => 'originating_account_id',
  'transaction_id' => 'transaction_id',
  'external_id' => 'external_id',
  'status' => 'status',
  'direction' => 'direction',
  'reference_number' => 'reference_number',
  'effective_date_start' => 'effective_date_start',
  'effective_date_end' => 'effective_date_end',
  'created_at_start' => 'created_at_start',
  'created_at_end' => 'created_at_end',
  'process_after_start' => 'process_after_start',
  'process_after_end' => 'process_after_end',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

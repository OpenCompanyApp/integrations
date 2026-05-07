<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list expected_payments.
 *
 * Maps to the official Modern Treasury endpoint get /api/expected_payments.
 */
class ModernTreasuryListExpectedPayments extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_expected_payments';
    protected const DESCRIPTION = 'list expected_payments

Official Modern Treasury endpoint: GET /api/expected_payments';
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
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'archived',
      1 => 'partially_reconciled',
      2 => 'reconciled',
      3 => 'unreconciled',
    ),
  ),
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
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
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'created_at_lower_bound' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_lower_bound` from the official Modern Treasury API operation.',
  ),
  'created_at_upper_bound' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_at_upper_bound` from the official Modern Treasury API operation.',
  ),
  'updated_at_lower_bound' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_at_lower_bound` from the official Modern Treasury API operation.',
  ),
  'updated_at_upper_bound' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_at_upper_bound` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/expected_payments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'status' => 'status',
  'internal_account_id' => 'internal_account_id',
  'external_id' => 'external_id',
  'direction' => 'direction',
  'type' => 'type',
  'counterparty_id' => 'counterparty_id',
  'created_at_lower_bound' => 'created_at_lower_bound',
  'created_at_upper_bound' => 'created_at_upper_bound',
  'updated_at_lower_bound' => 'updated_at_lower_bound',
  'updated_at_upper_bound' => 'updated_at_upper_bound',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

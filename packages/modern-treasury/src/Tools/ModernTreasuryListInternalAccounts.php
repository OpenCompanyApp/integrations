<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list internal accounts.
 *
 * Maps to the official Modern Treasury endpoint get /api/internal_accounts.
 */
class ModernTreasuryListInternalAccounts extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_internal_accounts';
    protected const DESCRIPTION = 'list internal accounts

Official Modern Treasury endpoint: GET /api/internal_accounts';
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
  'currency' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `currency` from the official Modern Treasury API operation.',
  ),
  'counterparty_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `counterparty_id` from the official Modern Treasury API operation.',
  ),
  'legal_entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `legal_entity_id` from the official Modern Treasury API operation.',
  ),
  'payment_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_type` from the official Modern Treasury API operation.',
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
  'payment_direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `payment_direction` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'credit',
      1 => 'debit',
    ),
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'active',
      1 => 'pending_activation',
      2 => 'suspended',
      3 => 'pending_closure',
      4 => 'closed',
    ),
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/internal_accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'currency' => 'currency',
  'counterparty_id' => 'counterparty_id',
  'legal_entity_id' => 'legal_entity_id',
  'payment_type' => 'payment_type',
  'payment_direction' => 'payment_direction',
  'status' => 'status',
  'external_id' => 'external_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

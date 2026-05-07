<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list payment_actions.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_actions.
 */
class ModernTreasuryListPaymentActions extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_payment_actions';
    protected const DESCRIPTION = 'list payment_actions

Official Modern Treasury endpoint: GET /api/payment_actions

Get a list of all payment actions.';
    protected const PARAMETERS = array (
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'stop',
      1 => 'issue',
    ),
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'pending',
      1 => 'processable',
      2 => 'processing',
      3 => 'sent',
      4 => 'acknowledged',
      5 => 'failed',
      6 => 'cancelled',
    ),
  ),
  'actionable_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `actionable_id` from the official Modern Treasury API operation.',
  ),
  'actionable_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `actionable_type` from the official Modern Treasury API operation.',
  ),
  'internal_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `internal_account_id` from the official Modern Treasury API operation.',
  ),
  'created_at' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `created_at` from the official Modern Treasury API operation.',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/payment_actions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'type' => 'type',
  'status' => 'status',
  'actionable_id' => 'actionable_id',
  'actionable_type' => 'actionable_type',
  'internal_account_id' => 'internal_account_id',
  'created_at' => 'created_at',
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list incoming payment_details.
 *
 * Maps to the official Modern Treasury endpoint get /api/incoming_payment_details.
 */
class ModernTreasuryListIncomingPaymentDetails extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_incoming_payment_details';
    protected const DESCRIPTION = 'list incoming payment_details

Official Modern Treasury endpoint: GET /api/incoming_payment_details

Get a list of Incoming Payment Details.';
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
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `status` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'completed',
      1 => 'pending',
      2 => 'returned',
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
      4 => 'check',
      5 => 'eft',
      6 => 'interac',
      7 => 'neft',
      8 => 'nz_becs',
      9 => 'rtp',
      10 => 'sepa',
      11 => 'signet',
      12 => 'stablecoin',
      13 => 'wire',
      14 => 'zengin',
    ),
  ),
  'as_of_date_start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `as_of_date_start` from the official Modern Treasury API operation.',
  ),
  'as_of_date_end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `as_of_date_end` from the official Modern Treasury API operation.',
  ),
  'virtual_account_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `virtual_account_id` from the official Modern Treasury API operation.',
  ),
  'subtype' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `subtype` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/incoming_payment_details';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'direction' => 'direction',
  'status' => 'status',
  'type' => 'type',
  'as_of_date_start' => 'as_of_date_start',
  'as_of_date_end' => 'as_of_date_end',
  'virtual_account_id' => 'virtual_account_id',
  'subtype' => 'subtype',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

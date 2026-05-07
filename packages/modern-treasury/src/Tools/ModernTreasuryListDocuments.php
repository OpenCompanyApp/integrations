<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list documents.
 *
 * Maps to the official Modern Treasury endpoint get /api/documents.
 */
class ModernTreasuryListDocuments extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_documents';
    protected const DESCRIPTION = 'list documents

Official Modern Treasury endpoint: GET /api/documents

Get a list of documents.';
    protected const PARAMETERS = array (
  'documentable_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `documentable_id` from the official Modern Treasury API operation.',
  ),
  'documentable_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `documentable_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'connections',
      1 => 'counterparties',
      2 => 'expected_payments',
      3 => 'external_accounts',
      4 => 'identifications',
      5 => 'incoming_payment_details',
      6 => 'internal_accounts',
      7 => 'legal_entities',
      8 => 'organizations',
      9 => 'payment_orders',
      10 => 'transactions',
    ),
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
    protected const PATH = '/api/documents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'documentable_id' => 'documentable_id',
  'documentable_type' => 'documentable_type',
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

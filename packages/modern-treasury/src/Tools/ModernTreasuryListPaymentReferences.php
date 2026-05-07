<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list payment_references.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_references.
 */
class ModernTreasuryListPaymentReferences extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_payment_references';
    protected const DESCRIPTION = 'list payment_references

Official Modern Treasury endpoint: GET /api/payment_references';
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
  'referenceable_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `referenceable_id` from the official Modern Treasury API operation.',
  ),
  'referenceable_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `referenceable_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'payment_order',
      1 => 'return',
      2 => 'reversal',
    ),
  ),
  'reference_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `reference_number` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/payment_references';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
  'referenceable_id' => 'referenceable_id',
  'referenceable_type' => 'referenceable_type',
  'reference_number' => 'reference_number',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

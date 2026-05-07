<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create document - nested path (legacy).
 *
 * Maps to the official Modern Treasury endpoint post /api/{documentable_type}/{documentable_id}/documents.
 */
class ModernTreasuryCreateDocumentNested extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_document_nested';
    protected const DESCRIPTION = 'create document - nested path (legacy)

Official Modern Treasury endpoint: POST /api/{documentable_type}/{documentable_id}/documents

Create a document.';
    protected const PARAMETERS = array (
  'documentable_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `documentable_type` from the official Modern Treasury API operation.',
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
  'documentable_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `documentable_id` from the official Modern Treasury API operation.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/{documentable_type}/{documentable_id}/documents';
    protected const PATH_PARAMS = array (
  'documentable_type' => 'documentable_type',
  'documentable_id' => 'documentable_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}

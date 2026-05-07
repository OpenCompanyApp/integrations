<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * collect account details.
 *
 * Maps to the official Modern Treasury endpoint post /api/counterparties/{id}/collect_account.
 */
class ModernTreasuryCollectAccountDetails extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_collect_account_details';
    protected const DESCRIPTION = 'collect account details

Official Modern Treasury endpoint: POST /api/counterparties/{id}/collect_account

Send an email requesting account details.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
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
    protected const PATH = '/api/counterparties/{id}/collect_account';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}

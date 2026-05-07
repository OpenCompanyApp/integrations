<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create account_detail.
 *
 * Maps to the official Modern Treasury endpoint post /api/{accounts_type}/{account_id}/account_details.
 */
class ModernTreasuryCreateAccountDetail extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_account_detail';
    protected const DESCRIPTION = 'create account_detail

Official Modern Treasury endpoint: POST /api/{accounts_type}/{account_id}/account_details

Create an account detail for an external account.';
    protected const PARAMETERS = array (
  'accounts_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `accounts_type` from the official Modern Treasury API operation.',
    'enum' =>
    array (
      0 => 'external_accounts',
    ),
  ),
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the official Modern Treasury API operation.',
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
    protected const PATH = '/api/{accounts_type}/{account_id}/account_details';
    protected const PATH_PARAMS = array (
  'accounts_type' => 'accounts_type',
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}

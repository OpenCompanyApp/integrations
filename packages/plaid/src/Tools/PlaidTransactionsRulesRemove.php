<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove transaction rule.
 *
 * Maps to the official Plaid endpoint post /beta/transactions/rules/v1/remove.
 */
class PlaidTransactionsRulesRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_rules_remove';
    protected const DESCRIPTION = 'Remove transaction rule

Official Plaid endpoint: POST /beta/transactions/rules/v1/remove

The `/transactions/rules/v1/remove` endpoint is used to remove a transaction rule.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/transactions/rules/v1/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
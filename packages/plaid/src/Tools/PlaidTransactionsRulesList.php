<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Return a list of rules created for the Item associated with the access token..
 *
 * Maps to the official Plaid endpoint post /beta/transactions/rules/v1/list.
 */
class PlaidTransactionsRulesList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_rules_list';
    protected const DESCRIPTION = 'Return a list of rules created for the Item associated with the access token.

Official Plaid endpoint: POST /beta/transactions/rules/v1/list

The `/transactions/rules/v1/list` returns a list of transaction rules created for the Item associated with the access token.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/transactions/rules/v1/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
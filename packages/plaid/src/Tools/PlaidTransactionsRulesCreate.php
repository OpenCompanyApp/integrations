<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create transaction category rule.
 *
 * Maps to the official Plaid endpoint post /beta/transactions/rules/v1/create.
 */
class PlaidTransactionsRulesCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transactions_rules_create';
    protected const DESCRIPTION = 'Create transaction category rule

Official Plaid endpoint: POST /beta/transactions/rules/v1/create

The `/transactions/rules/v1/create` endpoint creates transaction categorization rules. Rules will be applied on the Item\'s transactions returned in `/transactions/get` response. The product is currently in beta. To request access, contact transactions-feedback@plaid.com.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/transactions/rules/v1/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
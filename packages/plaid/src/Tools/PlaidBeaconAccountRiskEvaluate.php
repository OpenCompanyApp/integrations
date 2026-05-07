<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Evaluate risk of a bank account.
 *
 * Maps to the official Plaid endpoint post /beacon/account_risk/v1/evaluate.
 */
class PlaidBeaconAccountRiskEvaluate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_account_risk_evaluate';
    protected const DESCRIPTION = 'Evaluate risk of a bank account

Official Plaid endpoint: POST /beacon/account_risk/v1/evaluate

Use `/beacon/account_risk/v1/evaluate` to get risk insights for a linked account.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/account_risk/v1/evaluate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
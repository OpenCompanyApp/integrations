<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Manually fire an Income webhook.
 *
 * Maps to the official Plaid endpoint post /sandbox/income/fire_webhook.
 */
class PlaidSandboxIncomeFireWebhook extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_income_fire_webhook';
    protected const DESCRIPTION = 'Manually fire an Income webhook

Official Plaid endpoint: POST /sandbox/income/fire_webhook

Use the `/sandbox/income/fire_webhook` endpoint to manually trigger a Payroll or Document Income webhook in the Sandbox environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/income/fire_webhook';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
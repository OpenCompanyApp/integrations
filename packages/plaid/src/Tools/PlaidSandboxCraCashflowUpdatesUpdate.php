<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Trigger an update for Cash Flow Updates.
 *
 * Maps to the official Plaid endpoint post /sandbox/cra/cashflow_updates/update.
 */
class PlaidSandboxCraCashflowUpdatesUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_cra_cashflow_updates_update';
    protected const DESCRIPTION = 'Trigger an update for Cash Flow Updates

Official Plaid endpoint: POST /sandbox/cra/cashflow_updates/update

Use the `/sandbox/cra/cashflow_updates/update` endpoint to manually trigger an update for Cash Flow Updates (Monitoring) in the Sandbox environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/cra/cashflow_updates/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
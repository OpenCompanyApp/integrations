<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Trigger the creation of a repayment.
 *
 * Maps to the official Plaid endpoint post /sandbox/transfer/repayment/simulate.
 */
class PlaidSandboxTransferRepaymentSimulate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_transfer_repayment_simulate';
    protected const DESCRIPTION = 'Trigger the creation of a repayment

Official Plaid endpoint: POST /sandbox/transfer/repayment/simulate

Use the `/sandbox/transfer/repayment/simulate` endpoint to trigger the creation of a repayment. As a side effect of calling this route, a repayment is created that includes all unreimbursed returns of guaranteed transfers. If there are no such returns, an 400 error is returned.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/transfer/repayment/simulate';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
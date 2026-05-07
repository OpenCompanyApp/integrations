<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Unregister a list of loans..
 *
 * Maps to the official Plaid endpoint post /cra/loans/unregister.
 */
class PlaidCraLoansUnregister extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_loans_unregister';
    protected const DESCRIPTION = 'Unregister a list of loans.

Official Plaid endpoint: POST /cra/loans/unregister

`/cra/loans/unregister` indicates the loans have reached a final status and no further updates are expected.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/loans/unregister';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
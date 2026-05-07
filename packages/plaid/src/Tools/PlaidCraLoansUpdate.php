<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Updates loan data..
 *
 * Maps to the official Plaid endpoint post /cra/loans/update.
 */
class PlaidCraLoansUpdate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_loans_update';
    protected const DESCRIPTION = 'Updates loan data.

Official Plaid endpoint: POST /cra/loans/update

`/cra/loans/update` updates loan information such as the status and payment history.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/loans/update';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
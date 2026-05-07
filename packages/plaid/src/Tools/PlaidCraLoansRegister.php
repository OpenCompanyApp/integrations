<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Register a list of loans to their applicants..
 *
 * Maps to the official Plaid endpoint post /cra/loans/register.
 */
class PlaidCraLoansRegister extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_loans_register';
    protected const DESCRIPTION = 'Register a list of loans to their applicants.

Official Plaid endpoint: POST /cra/loans/register

`/cra/loans/register` registers a list of loans to their applicants.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/loans/register';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Register loan applications and decisions..
 *
 * Maps to the official Plaid endpoint post /cra/loans/applications/register.
 */
class PlaidCraLoansApplicationsRegister extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_loans_applications_register';
    protected const DESCRIPTION = 'Register loan applications and decisions.

Official Plaid endpoint: POST /cra/loans/applications/register

`/cra/loans/applications/register` registers loan applications and decisions.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/loans/applications/register';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
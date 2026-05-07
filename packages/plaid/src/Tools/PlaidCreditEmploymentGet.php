<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a summary of an individual's employment information.
 *
 * Maps to the official Plaid endpoint post /credit/employment/get.
 */
class PlaidCreditEmploymentGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_employment_get';
    protected const DESCRIPTION = 'Retrieve a summary of an individual\'s employment information

Official Plaid endpoint: POST /credit/employment/get

`/credit/employment/get` returns a list of items with employment information from a user\'s payroll provider that was verified by an end user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/employment/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
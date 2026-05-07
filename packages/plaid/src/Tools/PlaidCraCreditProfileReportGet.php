<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve the credit profile report for a user.
 *
 * Maps to the official Plaid endpoint post /cra/credit_profile/report/get.
 */
class PlaidCraCreditProfileReportGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_credit_profile_report_get';
    protected const DESCRIPTION = 'Retrieve the credit profile report for a user

Official Plaid endpoint: POST /cra/credit_profile/report/get

`/cra/credit_profile/report/get` retrieves a credit profile report for a user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/credit_profile/report/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
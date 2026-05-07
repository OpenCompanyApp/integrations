<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve cash flow information from your user's banks.
 *
 * Maps to the official Plaid endpoint post /cra/check_report/income_insights/get.
 */
class PlaidCraCheckReportIncomeInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_check_report_income_insights_get';
    protected const DESCRIPTION = 'Retrieve cash flow information from your user\'s banks

Official Plaid endpoint: POST /cra/check_report/income_insights/get

This endpoint allows you to retrieve the Income Insights report for your user. You should call this endpoint after you’ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPORT_READY` webhook, either after the Link session for the user or after calling `/cra/check_report/create`. If the most recent consumer report for the user doesn’t have sufficient data to generate the base report, or the consumer report has expired, you will receive an error indicating that you should create a new consumer report by calling `/cra/check_report/create`. NOTE: The following schema was updated in April 2026 to reflect the response when the provided version is "II2". Please see [this document](https://...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/check_report/income_insights/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
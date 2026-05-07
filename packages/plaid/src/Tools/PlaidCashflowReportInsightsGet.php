<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Gets insights data in Cashflow Report.
 *
 * Maps to the official Plaid endpoint post /cashflow_report/insights/get.
 */
class PlaidCashflowReportInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cashflow_report_insights_get';
    protected const DESCRIPTION = 'Gets insights data in Cashflow Report

Official Plaid endpoint: POST /cashflow_report/insights/get

The `/cashflow_report/insights/get` endpoint retrieves insights data associated with an item. Insights are only calculated on credit and depository accounts.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cashflow_report/insights/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
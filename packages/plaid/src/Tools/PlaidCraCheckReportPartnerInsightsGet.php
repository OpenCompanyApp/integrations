<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve cash flow insights from partners.
 *
 * Maps to the official Plaid endpoint post /cra/check_report/partner_insights/get.
 */
class PlaidCraCheckReportPartnerInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_check_report_partner_insights_get';
    protected const DESCRIPTION = 'Retrieve cash flow insights from partners

Official Plaid endpoint: POST /cra/check_report/partner_insights/get

This endpoint allows you to retrieve the Partner Insights report for your user. You should call this endpoint after you\'ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPORT_READY` webhook, either after the Link session for the user or after calling `/cra/check_report/create`. If the most recent consumer report for the user doesn’t have sufficient data to generate the base report, or the consumer report has expired, you will receive an error indicating that you should create a new consumer report by calling `/cra/check_report/create`. If you did not initialize Link with the `credit_partner_insights` product or have generated a report using `/cra/check_report/create`, we will call o...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/check_report/partner_insights/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
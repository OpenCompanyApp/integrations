<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve the LendScore from your user's banking data.
 *
 * Maps to the official Plaid endpoint post /cra/check_report/lend_score/get.
 */
class PlaidCraCheckReportLendScoreGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_check_report_lend_score_get';
    protected const DESCRIPTION = 'Retrieve the LendScore from your user\'s banking data

Official Plaid endpoint: POST /cra/check_report/lend_score/get

This endpoint allows you to retrieve the LendScore report for your user. You should call this endpoint after you\'ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPORT_READY` webhook, either after the Link session for the user or after calling `/cra/check_report/create`. If the most recent consumer report for the user doesn’t have sufficient data to generate the insights, or the consumer report has expired, you will receive an error indicating that you should create a new consumer report by calling `/cra/check_report/create`. If you did not initialize Link with the `cra_lend_score` product or call `/cra/check_report/create` with the `cra_lend_score` product, Plaid will generate the ...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/check_report/lend_score/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
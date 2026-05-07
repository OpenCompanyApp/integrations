<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve various home lending reports for a user..
 *
 * Maps to the official Plaid endpoint post /cra/check_report/verification/get.
 */
class PlaidCraCheckReportVerificationGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_check_report_verification_get';
    protected const DESCRIPTION = 'Retrieve various home lending reports for a user.

Official Plaid endpoint: POST /cra/check_report/verification/get

This endpoint allows you to retrieve home lending reports for a user. To obtain a VoA or Employment Refresh report, you need to make sure that `cra_base_report` is included in the `products` parameter when calling `/link/token/create` or `/cra/check_report/create`. You should call this endpoint after you\'ve received a `CHECK_REPORT_READY` or a `USER_CHECK_REPORT_READY` webhook, either after the Link session for the user or after calling `/cra/check_report/create`. If the most recent consumer report for the user doesn’t have sufficient data to generate the report, or the consumer report has expired, you will receive an error indicating that you should create a new consumer report by call...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/check_report/verification/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
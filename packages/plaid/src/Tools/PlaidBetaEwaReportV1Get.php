<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get EWA Score Report.
 *
 * Maps to the official Plaid endpoint post /beta/ewa_report/v1/get.
 */
class PlaidBetaEwaReportV1Get extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beta_ewa_report_v1_get';
    protected const DESCRIPTION = 'Get EWA Score Report

Official Plaid endpoint: POST /beta/ewa_report/v1/get

The `/beta/ewa_report/v1/get` endpoint provides an Earned Wage Access (EWA) score that quantifies the delinquency risk associated with a given item. The score is derived from a combination of cashflow patterns and network-based behavioral features. The response returns a list of EWA scores, where each score corresponds to a potential advance amount range. These scores estimate the likelihood of repayment for advances within that range. Score range: 1–99 Interpretation: Higher scores indicate a greater likelihood of repayment. This endpoint enables clients to assess repayment risk and make data-driven decisions when determining eligibility or limits for earned wage advances.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beta/ewa_report/v1/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
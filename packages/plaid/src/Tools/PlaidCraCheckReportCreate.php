<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh or create a Consumer Report.
 *
 * Maps to the official Plaid endpoint post /cra/check_report/create.
 */
class PlaidCraCheckReportCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_cra_check_report_create';
    protected const DESCRIPTION = 'Refresh or create a Consumer Report

Official Plaid endpoint: POST /cra/check_report/create

Use `/cra/check_report/create` to refresh data in an existing report. A Consumer Report will last for 24 hours before expiring; you should call any `/get` endpoints on the report before it expires. If a report expires, you can call `/cra/check_report/create` again to re-generate it and refresh the data in the report.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/cra/check_report/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
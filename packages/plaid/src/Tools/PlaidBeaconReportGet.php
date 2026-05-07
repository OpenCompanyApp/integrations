<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get a Beacon Report.
 *
 * Maps to the official Plaid endpoint post /beacon/report/get.
 */
class PlaidBeaconReportGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_report_get';
    protected const DESCRIPTION = 'Get a Beacon Report

Official Plaid endpoint: POST /beacon/report/get

Returns a Beacon report for a given Beacon report id.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/report/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
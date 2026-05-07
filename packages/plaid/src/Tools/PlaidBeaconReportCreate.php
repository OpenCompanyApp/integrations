<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a Beacon Report.
 *
 * Maps to the official Plaid endpoint post /beacon/report/create.
 */
class PlaidBeaconReportCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_report_create';
    protected const DESCRIPTION = 'Create a Beacon Report

Official Plaid endpoint: POST /beacon/report/create

Create a fraud report for a given Beacon User.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/report/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
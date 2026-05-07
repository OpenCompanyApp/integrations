<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get a Beacon Report Syndication.
 *
 * Maps to the official Plaid endpoint post /beacon/report_syndication/get.
 */
class PlaidBeaconReportSyndicationGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_report_syndication_get';
    protected const DESCRIPTION = 'Get a Beacon Report Syndication

Official Plaid endpoint: POST /beacon/report_syndication/get

Returns a Beacon Report Syndication for a given Beacon Report Syndication id.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/report_syndication/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
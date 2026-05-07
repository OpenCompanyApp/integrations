<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List Beacon Report Syndications for a Beacon User.
 *
 * Maps to the official Plaid endpoint post /beacon/report_syndication/list.
 */
class PlaidBeaconReportSyndicationList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_report_syndication_list';
    protected const DESCRIPTION = 'List Beacon Report Syndications for a Beacon User

Official Plaid endpoint: POST /beacon/report_syndication/list

Use the `/beacon/report_syndication/list` endpoint to view all Beacon Reports that have been syndicated to a specific Beacon User. This endpoint returns Beacon Report Syndications which are references to Beacon Reports created either by you, or another Beacon customer, that matched the specified Beacon User. A Beacon User can have multiple active Beacon Report Syndications at once. The results from this endpoint are paginated; the `next_cursor` field will be populated if there is another page of results that can be retrieved. To fetch the next page, pass the `next_cursor` value as the `cursor` parameter in the next request.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/report_syndication/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
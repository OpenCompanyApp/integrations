<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List Beacon Reports for a Beacon User.
 *
 * Maps to the official Plaid endpoint post /beacon/report/list.
 */
class PlaidBeaconReportList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_report_list';
    protected const DESCRIPTION = 'List Beacon Reports for a Beacon User

Official Plaid endpoint: POST /beacon/report/list

Use the `/beacon/report/list` endpoint to view all Beacon Reports you created for a specific Beacon User. The reports returned by this endpoint are exclusively reports you created for a specific user. A Beacon User can only have one active report at a time, but a new report can be created if a previous report has been deleted. The results from this endpoint are paginated; the `next_cursor` field will be populated if there is another page of results that can be retrieved. To fetch the next page, pass the `next_cursor` value as the `cursor` parameter in the next request.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/report/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
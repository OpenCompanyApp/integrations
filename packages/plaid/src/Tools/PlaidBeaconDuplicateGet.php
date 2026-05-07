<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get a Beacon Duplicate.
 *
 * Maps to the official Plaid endpoint post /beacon/duplicate/get.
 */
class PlaidBeaconDuplicateGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_duplicate_get';
    protected const DESCRIPTION = 'Get a Beacon Duplicate

Official Plaid endpoint: POST /beacon/duplicate/get

Returns a Beacon Duplicate for a given Beacon Duplicate id. A Beacon Duplicate represents a pair of similar Beacon Users within your organization. Two Beacon User revisions are returned for each Duplicate record in either the `beacon_user1` or `beacon_user2` response fields. The `analysis` field in the response indicates which fields matched between `beacon_user1` and `beacon_user2`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/duplicate/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
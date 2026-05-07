<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List a Beacon User's history.
 *
 * Maps to the official Plaid endpoint post /beacon/user/history/list.
 */
class PlaidBeaconUserHistoryList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_beacon_user_history_list';
    protected const DESCRIPTION = 'List a Beacon User\'s history

Official Plaid endpoint: POST /beacon/user/history/list

List all changes to the Beacon User in reverse-chronological order.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/beacon/user/history/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
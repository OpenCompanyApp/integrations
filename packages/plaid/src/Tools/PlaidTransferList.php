<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List transfers.
 *
 * Maps to the official Plaid endpoint post /transfer/list.
 */
class PlaidTransferList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_list';
    protected const DESCRIPTION = 'List transfers

Official Plaid endpoint: POST /transfer/list

Use the `/transfer/list` endpoint to see a list of all your transfers and their statuses. Results are paginated; use the `count` and `offset` query parameters to retrieve the desired transfers.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
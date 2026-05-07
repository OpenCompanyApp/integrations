<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List bank transfers.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/list.
 */
class PlaidBankTransferList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_list';
    protected const DESCRIPTION = 'List bank transfers

Official Plaid endpoint: POST /bank_transfer/list

Use the `/bank_transfer/list` endpoint to see a list of all your bank transfers and their statuses. Results are paginated; use the `count` and `offset` query parameters to retrieve the desired bank transfers.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
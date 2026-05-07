<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List the returns included in a repayment.
 *
 * Maps to the official Plaid endpoint post /transfer/repayment/return/list.
 */
class PlaidTransferRepaymentReturnList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_repayment_return_list';
    protected const DESCRIPTION = 'List the returns included in a repayment

Official Plaid endpoint: POST /transfer/repayment/return/list

The `/transfer/repayment/return/list` endpoint retrieves the set of returns that were batched together into the specified repayment. The sum of amounts of returns retrieved by this request equals the amount of the repayment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/repayment/return/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
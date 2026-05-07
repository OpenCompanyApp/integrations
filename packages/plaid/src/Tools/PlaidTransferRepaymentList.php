<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Lists historical repayments.
 *
 * Maps to the official Plaid endpoint post /transfer/repayment/list.
 */
class PlaidTransferRepaymentList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_repayment_list';
    protected const DESCRIPTION = 'Lists historical repayments

Official Plaid endpoint: POST /transfer/repayment/list

The `/transfer/repayment/list` endpoint fetches repayments matching the given filters. Repayments are returned in reverse-chronological order (most recent first) starting at the given `start_time`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/repayment/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
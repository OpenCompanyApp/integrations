<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a refund.
 *
 * Maps to the official Plaid endpoint post /transfer/refund/get.
 */
class PlaidTransferRefundGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_refund_get';
    protected const DESCRIPTION = 'Retrieve a refund

Official Plaid endpoint: POST /transfer/refund/get

The `/transfer/refund/get` endpoint fetches information about the refund corresponding to the given `refund_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/refund/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
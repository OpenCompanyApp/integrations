<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a refund.
 *
 * Maps to the official Plaid endpoint post /transfer/refund/create.
 */
class PlaidTransferRefundCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_refund_create';
    protected const DESCRIPTION = 'Create a refund

Official Plaid endpoint: POST /transfer/refund/create

Use the `/transfer/refund/create` endpoint to create a refund for a transfer. A transfer can be refunded if the transfer was initiated in the past 180 days. Refunds come out of the available balance of the ledger used for the original debit transfer. If there are not enough funds in the available balance to cover the refund amount, the refund will be rejected. You can create a refund at any time. Plaid does not impose any hold time on refunds. A refund can still be issued even if the Item\'s `access_token` is no longer valid (e.g. if the user revoked OAuth consent or the Item was deleted via `/item/remove`), as long as the account and routing number pair used to make the original transacti...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/refund/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
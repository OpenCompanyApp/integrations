<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Cancel a transfer authorization.
 *
 * Maps to the official Plaid endpoint post /transfer/authorization/cancel.
 */
class PlaidTransferAuthorizationCancel extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_authorization_cancel';
    protected const DESCRIPTION = 'Cancel a transfer authorization

Official Plaid endpoint: POST /transfer/authorization/cancel

Use the `/transfer/authorization/cancel` endpoint to cancel a transfer authorization. A transfer authorization is eligible for cancellation if it has not yet been used to create a transfer.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/authorization/cancel';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
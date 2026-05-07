<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a transfer authorization.
 *
 * Maps to the official Plaid endpoint post /transfer/authorization/create.
 */
class PlaidTransferAuthorizationCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_authorization_create';
    protected const DESCRIPTION = 'Create a transfer authorization

Official Plaid endpoint: POST /transfer/authorization/create

Use the `/transfer/authorization/create` endpoint to authorize a transfer. This endpoint must be called prior to calling `/transfer/create`. The transfer authorization will expire if not used after one hour. (You can contact your account manager to change the default authorization lifetime.) There are four possible outcomes to calling this endpoint: - If the `authorization.decision` in the response is `declined`, the proposed transfer has failed the risk check and you cannot proceed with the transfer. - If the `authorization.decision` is `user_action_required`, additional user input is needed, usually to fix a broken bank connection, before Plaid can properly assess the risk. You need to ...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/authorization/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
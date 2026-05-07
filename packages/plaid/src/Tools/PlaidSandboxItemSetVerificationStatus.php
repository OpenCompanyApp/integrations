<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Set verification status for Sandbox account.
 *
 * Maps to the official Plaid endpoint post /sandbox/item/set_verification_status.
 */
class PlaidSandboxItemSetVerificationStatus extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_item_set_verification_status';
    protected const DESCRIPTION = 'Set verification status for Sandbox account

Official Plaid endpoint: POST /sandbox/item/set_verification_status

The `/sandbox/item/set_verification_status` endpoint can be used to change the verification status of an Item in in the Sandbox in order to simulate the Automated Micro-deposit flow. For more information on testing Automated Micro-deposits in Sandbox, see [Auth full coverage testing](https://plaid.com/docs/auth/coverage/testing#).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/item/set_verification_status';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
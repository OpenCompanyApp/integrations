<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Force a Sandbox Item into an error state.
 *
 * Maps to the official Plaid endpoint post /sandbox/item/reset_login.
 */
class PlaidSandboxItemResetLogin extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_item_reset_login';
    protected const DESCRIPTION = 'Force a Sandbox Item into an error state

Official Plaid endpoint: POST /sandbox/item/reset_login

`/sandbox/item/reset_login/` forces an Item into an `ITEM_LOGIN_REQUIRED` state in order to simulate an Item whose login is no longer valid. This makes it easy to test Link\'s [update mode](https://plaid.com/docs/link/update-mode) flow in the Sandbox environment. After calling `/sandbox/item/reset_login`, You can then use Plaid Link update mode to restore the Item to a good state. An `ITEM_LOGIN_REQUIRED` webhook will also be fired after a call to this endpoint, if one is associated with the Item. In the Sandbox, Items will transition to an `ITEM_LOGIN_REQUIRED` error state automatically after 30 days, even if this endpoint is not called.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/item/reset_login';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
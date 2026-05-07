<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Force item(s) for a Sandbox User into an error state.
 *
 * Maps to the official Plaid endpoint post /sandbox/user/reset_login.
 */
class PlaidSandboxUserResetLogin extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_user_reset_login';
    protected const DESCRIPTION = 'Force item(s) for a Sandbox User into an error state

Official Plaid endpoint: POST /sandbox/user/reset_login

`/sandbox/user/reset_login/` functions the same as `/sandbox/item/reset_login`, but will modify Items related to a User. This endpoint forces each Item into an `ITEM_LOGIN_REQUIRED` state in order to simulate an Item whose login is no longer valid. This makes it easy to test Link\'s [update mode](https://plaid.com/docs/link/update-mode) flow in the Sandbox environment. After calling `/sandbox/user/reset_login`, You can then use Plaid Link update mode to restore Items associated with the User to a good state. An `ITEM_LOGIN_REQUIRED` webhook will also be fired after a call to this endpoint, if one is associated with the Item. In the Sandbox, Items will transition to an `ITEM_LOGIN_REQUIRED`...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/user/reset_login';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
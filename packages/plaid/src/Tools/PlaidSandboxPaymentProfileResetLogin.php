<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Reset the login of a Payment Profile.
 *
 * Maps to the official Plaid endpoint post /sandbox/payment_profile/reset_login.
 */
class PlaidSandboxPaymentProfileResetLogin extends AbstractPlaidTool
{
    protected const NAME = 'plaid_sandbox_payment_profile_reset_login';
    protected const DESCRIPTION = 'Reset the login of a Payment Profile

Official Plaid endpoint: POST /sandbox/payment_profile/reset_login

`/sandbox/payment_profile/reset_login/` forces a Payment Profile into a state where the login is no longer valid. This makes it easy to test update mode for Payment Profile in the Sandbox environment. After calling `/sandbox/payment_profile/reset_login`, calls to the `/transfer/authorization/create` with the Payment Profile will result in a `decision_rationale` `PAYMENT_PROFILE_LOGIN_REQUIRED`. You can then use update mode for Payment Profile to restore it into a good state. In order to invoke this endpoint, you must first [create a Payment Profile](https://plaid.com/docs/transfer/add-to-app/#create-a-payment-profile-optional) and [go through the Link flow](https://plaid.com/docs/transfer...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/sandbox/payment_profile/reset_login';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
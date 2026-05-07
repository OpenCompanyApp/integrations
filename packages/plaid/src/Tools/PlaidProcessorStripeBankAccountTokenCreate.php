<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create Stripe bank account token.
 *
 * Maps to the official Plaid endpoint post /processor/stripe/bank_account_token/create.
 */
class PlaidProcessorStripeBankAccountTokenCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_stripe_bank_account_token_create';
    protected const DESCRIPTION = 'Create Stripe bank account token

Official Plaid endpoint: POST /processor/stripe/bank_account_token/create

Used to create a token suitable for sending to Stripe to enable Plaid-Stripe integrations. For a detailed guide on integrating Stripe, see [Add Stripe to your app](https://plaid.com/docs/auth/partnerships/stripe/). Note that the Stripe bank account token is a one-time use token. To store bank account information for later use, you can use a Stripe customer object and create an associated bank account from the token, or you can use a Stripe Custom account and create an associated external bank account from the token. This bank account information should work indefinitely, unless the user\'s bank account information changes or they revoke Plaid\'s permissions to access their account. Stripe b...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/stripe/bank_account_token/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
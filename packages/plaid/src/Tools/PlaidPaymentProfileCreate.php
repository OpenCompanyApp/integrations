<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create payment profile.
 *
 * Maps to the official Plaid endpoint post /payment_profile/create.
 */
class PlaidPaymentProfileCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_profile_create';
    protected const DESCRIPTION = 'Create payment profile

Official Plaid endpoint: POST /payment_profile/create

Use `/payment_profile/create` endpoint to create a new payment profile. To initiate the account linking experience, call `/link/token/create` and provide the `payment_profile_token` in the `transfer.payment_profile_token` field. You can then use the `payment_profile_token` when creating transfers using `/transfer/authorization/create` and `/transfer/create`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_profile/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
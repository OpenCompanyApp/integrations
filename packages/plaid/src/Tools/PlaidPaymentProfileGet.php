<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get payment profile.
 *
 * Maps to the official Plaid endpoint post /payment_profile/get.
 */
class PlaidPaymentProfileGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_profile_get';
    protected const DESCRIPTION = 'Get payment profile

Official Plaid endpoint: POST /payment_profile/get

Use `/payment_profile/get` endpoint to get the status of a given Payment Profile.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_profile/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
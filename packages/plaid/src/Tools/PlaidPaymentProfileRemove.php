<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Remove payment profile.
 *
 * Maps to the official Plaid endpoint post /payment_profile/remove.
 */
class PlaidPaymentProfileRemove extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_profile_remove';
    protected const DESCRIPTION = 'Remove payment profile

Official Plaid endpoint: POST /payment_profile/remove

Use the `/payment_profile/remove` endpoint to remove a given Payment Profile. Once it’s removed, it can no longer be used to create transfers.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_profile/remove';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
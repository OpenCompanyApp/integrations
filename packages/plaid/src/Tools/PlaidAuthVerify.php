<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Verify auth data.
 *
 * Maps to the official Plaid endpoint post /auth/verify.
 */
class PlaidAuthVerify extends AbstractPlaidTool
{
    protected const NAME = 'plaid_auth_verify';
    protected const DESCRIPTION = 'Verify auth data

Official Plaid endpoint: POST /auth/verify

The `/auth/verify` endpoint verifies bank account and routing numbers and (optionally) account owner names against Plaid\'s database via [Database Auth](https://plaid.com/docs/auth/coverage/database-auth/). It can be used to verify account numbers that were not collected via the Plaid Link flow. This endpoint is currently in Early Availability; contact Sales or your Plaid account manager to request access.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/auth/verify';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
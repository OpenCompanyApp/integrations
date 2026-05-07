<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve identity match score.
 *
 * Maps to the official Plaid endpoint post /processor/identity/match.
 */
class PlaidProcessorIdentityMatch extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_identity_match';
    protected const DESCRIPTION = 'Retrieve identity match score

Official Plaid endpoint: POST /processor/identity/match

The `/processor/identity/match` endpoint generates a match score, which indicates how well the provided identity data matches the identity information on file with the account holder\'s financial institution. Fields within the `balances` object will always be null when retrieved by `/identity/match`. Instead, use the free `/accounts/get` endpoint to request balance cached data, or `/accounts/balance/get` for real-time data.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/identity/match';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
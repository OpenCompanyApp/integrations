<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retry an Identity Verification.
 *
 * Maps to the official Plaid endpoint post /identity_verification/retry.
 */
class PlaidIdentityVerificationRetry extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_verification_retry';
    protected const DESCRIPTION = 'Retry an Identity Verification

Official Plaid endpoint: POST /identity_verification/retry

Allow a customer to retry their Identity Verification';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity_verification/retry';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
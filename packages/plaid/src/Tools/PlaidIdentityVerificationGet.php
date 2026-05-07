<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve Identity Verification.
 *
 * Maps to the official Plaid endpoint post /identity_verification/get.
 */
class PlaidIdentityVerificationGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_verification_get';
    protected const DESCRIPTION = 'Retrieve Identity Verification

Official Plaid endpoint: POST /identity_verification/get

Retrieve a previously created Identity Verification.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity_verification/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
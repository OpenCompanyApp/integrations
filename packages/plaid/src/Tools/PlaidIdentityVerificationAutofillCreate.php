<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create autofill for an Identity Verification.
 *
 * Maps to the official Plaid endpoint post /identity_verification/autofill/create.
 */
class PlaidIdentityVerificationAutofillCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_verification_autofill_create';
    protected const DESCRIPTION = 'Create autofill for an Identity Verification

Official Plaid endpoint: POST /identity_verification/autofill/create

Try to autofill an Identity Verification based of the provided phone number, date of birth and country of residence.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity_verification/autofill/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
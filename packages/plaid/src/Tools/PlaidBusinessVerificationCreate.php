<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a business verification.
 *
 * Maps to the official Plaid endpoint post /business_verification/create.
 */
class PlaidBusinessVerificationCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_business_verification_create';
    protected const DESCRIPTION = 'Create a business verification

Official Plaid endpoint: POST /business_verification/create

Create a new business verification to check a business\'s identity and risk profile.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/business_verification/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
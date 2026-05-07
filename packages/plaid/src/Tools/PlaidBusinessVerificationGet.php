<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get a business verification.
 *
 * Maps to the official Plaid endpoint post /business_verification/get.
 */
class PlaidBusinessVerificationGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_business_verification_get';
    protected const DESCRIPTION = 'Get a business verification

Official Plaid endpoint: POST /business_verification/get

Retrieve the current state of a specific business verification.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/business_verification/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
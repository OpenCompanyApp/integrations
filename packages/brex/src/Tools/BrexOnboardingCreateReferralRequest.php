<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Creates a referral.
 *
 * Maps to the official Brex endpoint post /v1/referrals.
 */
class BrexOnboardingCreateReferralRequest extends AbstractBrexTool
{
    protected const NAME = 'brex_onboarding_create_referral_request';
    protected const DESCRIPTION = 'Creates a referral

Official Brex endpoint: POST /v1/referrals

This creates new referrals. The response will contain an identifier and a unique personalized link to an application flow. Many fields are optional and when they\'re provided they\'ll prefill the application flow for Brex. You should handle and store these references securely as they contain sensitive information about the referral.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/referrals';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

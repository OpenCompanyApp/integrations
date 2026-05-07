<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Gets a referral by ID.
 *
 * Maps to the official Brex endpoint get /v1/referrals/{id}.
 */
class BrexOnboardingGetReferral extends AbstractBrexTool
{
    protected const NAME = 'brex_onboarding_get_referral';
    protected const DESCRIPTION = 'Gets a referral by ID

Official Brex endpoint: GET /v1/referrals/{id}

Returns a referral object by ID if it exists.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/referrals/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

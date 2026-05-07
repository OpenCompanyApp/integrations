<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List referrals.
 *
 * Maps to the official Brex endpoint get /v1/referrals.
 */
class BrexOnboardingListReferrals extends AbstractBrexTool
{
    protected const NAME = 'brex_onboarding_list_referrals';
    protected const DESCRIPTION = 'List referrals

Official Brex endpoint: GET /v1/referrals

Returns referrals created. *Note*: This doesn\'t include referrals that have expired.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/referrals';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

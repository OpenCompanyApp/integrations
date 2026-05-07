<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Submit additional onboarding information on behalf of an originator.
 *
 * Maps to the official Plaid endpoint post /transfer/platform/requirement/submit.
 */
class PlaidTransferPlatformRequirementSubmit extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_platform_requirement_submit';
    protected const DESCRIPTION = 'Submit additional onboarding information on behalf of an originator

Official Plaid endpoint: POST /transfer/platform/requirement/submit

Use the `/transfer/platform/requirement/submit` endpoint to submit additional onboarding information that is needed by Plaid to approve or decline the originator. See [Requirement type schema documentation](https://docs.google.com/document/d/1NEQkTD0sVK50iAQi6xHigrexDUxZ4QxXqSEfV_FFTiU/) for a list of requirement types and possible values.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/platform/requirement/submit';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
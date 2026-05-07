<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get Protect user insights.
 *
 * Maps to the official Plaid endpoint post /protect/user/insights/get.
 */
class PlaidProtectUserInsightsGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_protect_user_insights_get';
    protected const DESCRIPTION = 'Get Protect user insights

Official Plaid endpoint: POST /protect/user/insights/get

Use this endpoint to get basic information about a user as it relates to their fraud profile with Protect.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/protect/user/insights/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
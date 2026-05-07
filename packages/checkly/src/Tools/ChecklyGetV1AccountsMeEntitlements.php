<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Fetch the entitlements for the account, including feature access and limits based on the current plan..
 *
 * Maps to the official Checkly endpoint GET /v1/accounts/me/entitlements.
 */
class ChecklyGetV1AccountsMeEntitlements extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_accounts_me_entitlements';
    protected const DESCRIPTION = 'Fetch the entitlements for the account, including feature access and limits based on the current plan.

Official Checkly endpoint: GET /v1/accounts/me/entitlements.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/me/entitlements';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

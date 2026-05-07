<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Fetch the entitlements for the account, including feature access and limits based on the current plan..
 *
 * Maps to the official Checkly endpoint GET /v1/accounts/{accountId}/entitlements.
 */
class ChecklyGetV1AccountsAccountidEntitlements extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_accounts_accountid_entitlements';
    protected const DESCRIPTION = 'Fetch the entitlements for the account, including feature access and limits based on the current plan.

Official Checkly endpoint: GET /v1/accounts/{accountId}/entitlements.';
    protected const PARAMETERS = array (
      'account_id' => array (
        'type' => 'string',
        'description' => 'accountId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{accountId}/entitlements';
    protected const PATH_PARAMS = array (
      'accountId' => 'account_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

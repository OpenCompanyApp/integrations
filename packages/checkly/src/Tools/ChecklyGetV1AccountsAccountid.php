<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get details from a specific account..
 *
 * Maps to the official Checkly endpoint GET /v1/accounts/{accountId}.
 */
class ChecklyGetV1AccountsAccountid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_accounts_accountid';
    protected const DESCRIPTION = 'Get details from a specific account.

Official Checkly endpoint: GET /v1/accounts/{accountId}.';
    protected const PARAMETERS = array (
      'account_id' => array (
        'type' => 'string',
        'description' => 'accountId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{accountId}';
    protected const PATH_PARAMS = array (
      'accountId' => 'account_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

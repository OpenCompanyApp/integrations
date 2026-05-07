<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get details from the current account..
 *
 * Maps to the official Checkly endpoint GET /v1/accounts/me.
 */
class ChecklyGetV1AccountsMe extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_accounts_me';
    protected const DESCRIPTION = 'Get details from the current account.

Official Checkly endpoint: GET /v1/accounts/me.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/me';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

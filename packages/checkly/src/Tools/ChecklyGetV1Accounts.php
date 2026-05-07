<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * List account details based on supplied API key..
 *
 * Maps to the official Checkly endpoint GET /v1/accounts.
 */
class ChecklyGetV1Accounts extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_accounts';
    protected const DESCRIPTION = 'List account details based on supplied API key.

Official Checkly endpoint: GET /v1/accounts.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Service Accounts.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/service-accounts.
 */
class LangSmithGetServiceAccounts extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_service_accounts';
    protected const DESCRIPTION = 'Get Service Accounts

Official endpoint: GET /api/v1/service-accounts
Get the current organization\'s service accounts.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/service-accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

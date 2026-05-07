<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Organization Billing Info.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/billing.
 */
class LangSmithGetOrganizationBillingInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_organization_billing_info';
    protected const DESCRIPTION = 'Get Organization Billing Info

Official endpoint: GET /api/v1/orgs/current/billing
Get Organization Billing Info.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/billing';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

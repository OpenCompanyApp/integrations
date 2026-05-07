<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Customers And Get Stripe Setup Intent.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/setup.
 */
class LangSmithCreateCustomersAndGetStripeSetupIntent extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_customers_and_get_stripe_setup_intent';
    protected const DESCRIPTION = 'Create Customers And Get Stripe Setup Intent

Official endpoint: POST /api/v1/orgs/current/setup
Create Customers And Get Stripe Setup Intent.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/setup';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Stripe Account Links Endpoint.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/stripe_account_links.
 */
class LangSmithCreateStripeAccountLinksEndpoint extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_stripe_account_links_endpoint';
    protected const DESCRIPTION = 'Create Stripe Account Links Endpoint

Official endpoint: POST /api/v1/orgs/current/stripe_account_links
Kick off a Stripe account link flow.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/stripe_account_links';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

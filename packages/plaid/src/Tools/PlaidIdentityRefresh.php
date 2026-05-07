<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh identity data.
 *
 * Maps to the official Plaid endpoint post /identity/refresh.
 */
class PlaidIdentityRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_identity_refresh';
    protected const DESCRIPTION = 'Refresh identity data

Official Plaid endpoint: POST /identity/refresh

`/identity/refresh` is an optional endpoint for users of the Identity product. It initiates an on-demand extraction to fetch the most up to date Identity information from the Financial Institution. This on-demand extraction takes place in addition to the periodic extractions that automatically occur for any Identity-enabled Item. If changes to Identity are discovered after calling `/identity/refresh`, Plaid will fire a webhook [`DEFAULT_UPDATE`](https://plaid.com/docs/api/products/identity/#default_update). As this endpoint triggers a synchronous request for fresh data, latency may be higher than for other Plaid endpoints (typically less than 10 seconds, but occasionally up to 30 seconds ...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/identity/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve real-time balance data.
 *
 * Maps to the official Plaid endpoint post /accounts/balance/get.
 */
class PlaidAccountsBalanceGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_accounts_balance_get';
    protected const DESCRIPTION = 'Retrieve real-time balance data

Official Plaid endpoint: POST /accounts/balance/get

The `/accounts/balance/get` endpoint returns the real-time balance for each of an Item\'s accounts. While other endpoints, such as `/accounts/get`, return a balance object, `/accounts/balance/get` forces the available and current balance fields to be refreshed rather than cached. This endpoint can be used for existing Items that were added via any of Plaid’s other products. This endpoint can be used as long as Link has been initialized with any other product, `balance` itself is not a product that can be used to initialize Link. As this endpoint triggers a synchronous request for fresh data, latency may be higher than for other Plaid endpoints (typically less than 10 seconds, but occasio...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/accounts/balance/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
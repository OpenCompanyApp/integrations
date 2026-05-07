<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get investment account authentication data.
 *
 * Maps to the official Plaid endpoint post /processor/investments/auth/get.
 */
class PlaidProcessorInvestmentsAuthGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_processor_investments_auth_get';
    protected const DESCRIPTION = 'Get investment account authentication data

Official Plaid endpoint: POST /processor/investments/auth/get

The `/processor/investments/auth/get` endpoint allows you to retrieve information about the account authorized by a processor token, including account numbers, account owners, holdings, and data provenance information. To receive Investments Auth webhooks for a processor token, set its webhook URL via the [`/processor/token/webhook/update`](https://plaid.com/docs/api/processor-partners/#processortokenwebhookupdate) endpoint.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/processor/investments/auth/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
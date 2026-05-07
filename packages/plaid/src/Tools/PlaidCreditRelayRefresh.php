<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Refresh a report of a relay token.
 *
 * Maps to the official Plaid endpoint post /credit/relay/refresh.
 */
class PlaidCreditRelayRefresh extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_relay_refresh';
    protected const DESCRIPTION = 'Refresh a report of a relay token

Official Plaid endpoint: POST /credit/relay/refresh

The `/credit/relay/refresh` endpoint allows third parties to refresh a report that was relayed to them, using a `relay_token` that was created by the report owner. A new report will be created with the original report parameters, but with the most recent data available based on the `days_requested` value of the original report.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/relay/refresh';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
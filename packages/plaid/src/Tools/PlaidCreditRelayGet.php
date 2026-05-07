<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve the reports associated with a relay token that was shared with you.
 *
 * Maps to the official Plaid endpoint post /credit/relay/get.
 */
class PlaidCreditRelayGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_relay_get';
    protected const DESCRIPTION = 'Retrieve the reports associated with a relay token that was shared with you

Official Plaid endpoint: POST /credit/relay/get

`/credit/relay/get` allows third parties to receive a report that was shared with them, using a `relay_token` that was created by the report owner.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/relay/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
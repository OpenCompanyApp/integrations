<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create a relay token to share an Asset Report with a partner client.
 *
 * Maps to the official Plaid endpoint post /credit/relay/create.
 */
class PlaidCreditRelayCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_relay_create';
    protected const DESCRIPTION = 'Create a relay token to share an Asset Report with a partner client

Official Plaid endpoint: POST /credit/relay/create

Plaid can share an Asset Report directly with a participating third party on your behalf. The shared Asset Report is the exact same Asset Report originally created in `/asset_report/create`. To grant a third party access to an Asset Report, use the `/credit/relay/create` endpoint to create a `relay_token` and then pass that token to your third party. Each third party has its own `secondary_client_id`; for example, `ce5bd328dcd34123456`. You\'ll need to create a separate `relay_token` for each third party that needs access to the report on your behalf.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/relay/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
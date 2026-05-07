<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Sync bank transfer events.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/event/sync.
 */
class PlaidBankTransferEventSync extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_event_sync';
    protected const DESCRIPTION = 'Sync bank transfer events

Official Plaid endpoint: POST /bank_transfer/event/sync

`/bank_transfer/event/sync` allows you to request up to the next 25 Plaid-initiated bank transfer events that happened after a specific `event_id`. When using Auth with micro-deposit verification enabled, this endpoint can be used to fetch status updates on ACH micro-deposits. For more details, see [micro-deposit events](https://plaid.com/docs/auth/coverage/microdeposit-events/).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/event/sync';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
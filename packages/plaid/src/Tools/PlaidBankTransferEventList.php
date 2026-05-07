<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List bank transfer events.
 *
 * Maps to the official Plaid endpoint post /bank_transfer/event/list.
 */
class PlaidBankTransferEventList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_bank_transfer_event_list';
    protected const DESCRIPTION = 'List bank transfer events

Official Plaid endpoint: POST /bank_transfer/event/list

Use the `/bank_transfer/event/list` endpoint to get a list of Plaid-initiated ACH or bank transfer events based on specified filter criteria. When using Auth with micro-deposit verification enabled, this endpoint can be used to fetch status updates on ACH micro-deposits. For more details, see [micro-deposit events](https://plaid.com/docs/auth/coverage/microdeposit-events/).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/bank_transfer/event/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
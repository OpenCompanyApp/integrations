<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single payout.
 *
 * Maps to the official GoCardless endpoint GET /payouts/{payout_id}.
 */
class GoCardlessGetPayouts extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_payouts';
    protected const DESCRIPTION = 'Retrieves the details of a single payout. For an example of how to reconcile the transactions in a payout, see [this guide](#events-reconciling-payouts-with-events).

Official GoCardless endpoint: GET /payouts/{payout_id}.';
    protected const PARAMETERS = [
        'payout_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payout id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payouts/{payout_id}';
    protected const PATH_PARAMS = [
        'payout_id' => 'payout_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

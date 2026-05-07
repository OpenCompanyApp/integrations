<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get all payout items in a single payout.
 *
 * Maps to the official GoCardless endpoint GET /payout_items.
 */
class GoCardlessListPayoutItem extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_payout_item';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of items in the payout. <strong>This endpoint only serves requests for payouts created in the last 6 months. Requests for older payouts will return an HTTP status <code>410 Gone</code>.</strong>

Official GoCardless endpoint: GET /payout_items.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/payout_items';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Outbound payment statistics.
 *
 * Maps to the official GoCardless endpoint GET /outbound_payments/stats.
 */
class GoCardlessListOutboundPaymentsStats extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_outbound_payments_stats';
    protected const DESCRIPTION = 'Retrieve aggregate statistics on outbound payments.

Official GoCardless endpoint: GET /outbound_payments/stats.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/outbound_payments/stats';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

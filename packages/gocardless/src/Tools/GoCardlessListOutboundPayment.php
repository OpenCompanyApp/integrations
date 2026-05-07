<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List outbound payments.
 *
 * Maps to the official GoCardless endpoint GET /outbound_payments.
 */
class GoCardlessListOutboundPayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_outbound_payment';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of outbound payments.

Official GoCardless endpoint: GET /outbound_payments.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/outbound_payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List outbound payment imports.
 *
 * Maps to the official GoCardless endpoint GET /outbound_payment_imports.
 */
class GoCardlessListOutboundPaymentImport extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_outbound_payment_import';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your outbound payment imports.

Official GoCardless endpoint: GET /outbound_payment_imports.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/outbound_payment_imports';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

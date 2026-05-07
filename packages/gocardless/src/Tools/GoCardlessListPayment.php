<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List payments.
 *
 * Maps to the official GoCardless endpoint GET /payments.
 */
class GoCardlessListPayment extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_payment';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your payments.

Official GoCardless endpoint: GET /payments.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

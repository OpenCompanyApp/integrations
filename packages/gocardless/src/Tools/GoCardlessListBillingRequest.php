<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List Billing Requests.
 *
 * Maps to the official GoCardless endpoint GET /billing_requests.
 */
class GoCardlessListBillingRequest extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_billing_request';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your billing requests.

Official GoCardless endpoint: GET /billing_requests.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/billing_requests';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

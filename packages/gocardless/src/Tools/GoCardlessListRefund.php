<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List refunds.
 *
 * Maps to the official GoCardless endpoint GET /refunds.
 */
class GoCardlessListRefund extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_refund';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your refunds.

Official GoCardless endpoint: GET /refunds.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/refunds';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

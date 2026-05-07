<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List customers.
 *
 * Maps to the official GoCardless endpoint GET /customers.
 */
class GoCardlessListCustomer extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_customer';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your customers.

Official GoCardless endpoint: GET /customers.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/customers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

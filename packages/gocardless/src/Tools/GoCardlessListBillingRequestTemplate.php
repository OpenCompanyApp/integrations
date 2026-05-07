<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List Billing Request Templates.
 *
 * Maps to the official GoCardless endpoint GET /billing_request_templates.
 */
class GoCardlessListBillingRequestTemplate extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_billing_request_template';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your Billing Request Templates.

Official GoCardless endpoint: GET /billing_request_templates.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/billing_request_templates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

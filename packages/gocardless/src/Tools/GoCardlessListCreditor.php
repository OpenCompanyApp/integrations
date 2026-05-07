<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List creditors.
 *
 * Maps to the official GoCardless endpoint GET /creditors.
 */
class GoCardlessListCreditor extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_creditor';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your creditors.

Official GoCardless endpoint: GET /creditors.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/creditors';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

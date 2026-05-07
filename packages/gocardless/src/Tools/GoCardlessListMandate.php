<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List mandates.
 *
 * Maps to the official GoCardless endpoint GET /mandates.
 */
class GoCardlessListMandate extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_mandate';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your mandates.

Official GoCardless endpoint: GET /mandates.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/mandates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List events.
 *
 * Maps to the official GoCardless endpoint GET /events.
 */
class GoCardlessListEvent extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_event';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your events.

Official GoCardless endpoint: GET /events.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/events';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

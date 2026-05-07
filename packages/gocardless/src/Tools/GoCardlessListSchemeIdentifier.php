<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List scheme identifiers.
 *
 * Maps to the official GoCardless endpoint GET /scheme_identifiers.
 */
class GoCardlessListSchemeIdentifier extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_scheme_identifier';
    protected const DESCRIPTION = 'Returns a [cursor-paginated](#api-usage-cursor-pagination) list of your scheme identifiers.

Official GoCardless endpoint: GET /scheme_identifiers.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/scheme_identifiers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

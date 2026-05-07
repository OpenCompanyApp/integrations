<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List exports.
 *
 * Maps to the official GoCardless endpoint GET /exports.
 */
class GoCardlessListExport extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_export';
    protected const DESCRIPTION = 'Returns a list of exports which are available for download.

Official GoCardless endpoint: GET /exports.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/exports';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

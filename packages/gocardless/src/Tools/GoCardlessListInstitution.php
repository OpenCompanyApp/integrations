<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List Institutions.
 *
 * Maps to the official GoCardless endpoint GET /institutions.
 */
class GoCardlessListInstitution extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_institution';
    protected const DESCRIPTION = 'Returns a list of supported institutions.

Official GoCardless endpoint: GET /institutions.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/institutions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

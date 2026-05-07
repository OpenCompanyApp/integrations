<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List all mandate import entries.
 *
 * Maps to the official GoCardless endpoint GET /mandate_import_entries.
 */
class GoCardlessListMandateImportEntry extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_list_mandate_import_entry';
    protected const DESCRIPTION = 'For an existing mandate import, this endpoint lists all of the entries attached. After a mandate import has been submitted, you can use this endpoint to associate records in your system (using the `record_identifier` that you provided when creating the mandate import).

Official GoCardless endpoint: GET /mandate_import_entries.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/mandate_import_entries';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

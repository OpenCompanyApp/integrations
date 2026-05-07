<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List label ledger entries.
 *
 * Maps to the official Dwolla endpoint GET /labels/{id}/ledger-entries.
 */
class DwollaListLabelLedgerEntries extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_label_ledger_entries';
    protected const DESCRIPTION = 'Returns all ledger entries for a specific Label, sorted by creation date (newest first). Supports pagination with limit and offset parameters. Each ledger entry includes its amount, currency, and creation timestamp.

Official Dwolla endpoint: GET /labels/{id}/ledger-entries.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A label unique identifier',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to return',
        ],
        'offset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'How many results to skip',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/labels/{id}/ledger-entries';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'offset' => 'offset',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

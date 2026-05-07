<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a label ledger entry.
 *
 * Maps to the official Dwolla endpoint POST /labels/{id}/ledger-entries.
 */
class DwollaCreateLabelLedgerEntry extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_label_ledger_entry';
    protected const DESCRIPTION = 'Create a new ledger entry to track fund adjustments on a Label by specifying a positive or negative amount value. Returns the location of the created ledger entry in the response header. Label amounts cannot go negative, so validation errors occur if the entry would result in a negative Label balance.

Official Dwolla endpoint: POST /labels/{id}/ledger-entries.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The Id of the Label to update.',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/labels/{id}/ledger-entries';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

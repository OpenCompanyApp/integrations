<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a label ledger entry.
 *
 * Maps to the official Dwolla endpoint GET /ledger-entries/{ledgerEntryId}.
 */
class DwollaGetLabelLedgerEntry extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_label_ledger_entry';
    protected const DESCRIPTION = 'Returns detailed information for a specific ledger entry on a Label, including its amount, currency, and creation timestamp.

Official Dwolla endpoint: GET /ledger-entries/{ledgerEntryId}.';
    protected const PARAMETERS = [
        'ledger_entry_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A label ledger entry unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/ledger-entries/{ledgerEntryId}';
    protected const PATH_PARAMS = [
        'ledgerEntryId' => 'ledger_entry_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

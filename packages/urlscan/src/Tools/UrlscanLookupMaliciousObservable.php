<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Malicious observable lookup.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/malicious/{type}/{value}.
 */
class UrlscanLookupMaliciousObservable extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_lookup_malicious_observable';
    protected const DESCRIPTION = 'Malicious observable lookup

Official urlscan.io endpoint: GET /api/v1/malicious/{type}/{value}.';
    protected const PARAMETERS = [
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The type of observable to look up.',
            'enum' => ['ip', 'hostname', 'domain', 'url'],
        ],
        'value' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The observable value. Format depends on `type`: - `ip`: an IP address (e.g. `192.0.2.1`) - `hostname`: a fully qualified hostname (e.g. `www.example.com`) - `domain`: an apex/registered domain (e.g. `example.com`) - `url`: a URL-encoded URL (e.g. `https%3A%2F%',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/malicious/{type}/{value}';
    protected const PATH_PARAMS = [
        'type' => 'type',
        'value' => 'value',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}

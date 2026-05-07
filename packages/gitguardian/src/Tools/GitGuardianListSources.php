<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List sources.
 *
 * Maps to the official GitGuardian endpoint GET /v1/sources.
 */
class GitGuardianListSources extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_sources';
    protected const DESCRIPTION = 'List sources known by GitGuardian.

Official GitGuardian endpoint: GET /v1/sources.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Page number.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'last_scan_status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'last_scan_status',
        ],
        'health' => [
            'type' => 'string',
            'required' => false,
            'description' => 'health',
        ],
        'type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'type',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['last_scan_date', '-last_scan_date'],
        ],
        'visibility' => [
            'type' => 'string',
            'required' => false,
            'description' => 'visibility',
            'enum' => ['public', 'private', 'internal'],
        ],
        'external_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'external_id',
        ],
        'source_criticality' => [
            'type' => 'string',
            'required' => false,
            'description' => 'source_criticality',
            'enum' => ['critical', 'high', 'medium', 'low', 'unknown'],
        ],
        'monitored' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'monitored',
        ],
        'provider_metadata_archived' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'provider_metadata_archived',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/sources';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'page' => 'page',
        'per_page' => 'per_page',
        'search' => 'search',
        'last_scan_status' => 'last_scan_status',
        'health' => 'health',
        'type' => 'type',
        'ordering' => 'ordering',
        'visibility' => 'visibility',
        'external_id' => 'external_id',
        'source_criticality' => 'source_criticality',
        'monitored' => 'monitored',
        'provider_metadata_archived' => 'provider_metadata_archived',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

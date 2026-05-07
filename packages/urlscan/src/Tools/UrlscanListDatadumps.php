<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * List Data Dump Files.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/datadump/list/{timeWindow}/{fileType}/{date}.
 */
class UrlscanListDatadumps extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_list_datadumps';
    protected const DESCRIPTION = 'List Data Dump Files

Official urlscan.io endpoint: GET /api/v1/datadump/list/{timeWindow}/{fileType}/{date}.';
    protected const PARAMETERS = [
        'time_window' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Time window of the data dump',
            'enum' => ['days', 'hours', 'minutes'],
        ],
        'file_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Type of data dump file',
            'enum' => ['api', 'search', 'screenshot', 'dom'],
        ],
        'date' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Date of the data dump in YYYYMMDD format',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datadump/list/{timeWindow}/{fileType}/{date}';
    protected const PATH_PARAMS = [
        'timeWindow' => 'time_window',
        'fileType' => 'file_type',
        'date' => 'date',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}

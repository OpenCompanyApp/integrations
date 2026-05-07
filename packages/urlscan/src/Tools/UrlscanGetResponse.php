<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Response.
 *
 * Maps to the official urlscan.io endpoint GET /responses/{fileHash}/.
 */
class UrlscanGetResponse extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_response';
    protected const DESCRIPTION = 'Response

Official urlscan.io endpoint: GET /responses/{fileHash}/.';
    protected const PARAMETERS = [
        'file_hash' => [
            'type' => 'string',
            'required' => true,
            'description' => 'SHA256 hash of response',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/responses/{fileHash}/';
    protected const PATH_PARAMS = [
        'fileHash' => 'file_hash',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}

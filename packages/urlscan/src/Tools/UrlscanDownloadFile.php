<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Download a file.
 *
 * Maps to the official urlscan.io endpoint GET /downloads/{fileHash}.
 */
class UrlscanDownloadFile extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_download_file';
    protected const DESCRIPTION = 'Download a file

Official urlscan.io endpoint: GET /downloads/{fileHash}.';
    protected const PARAMETERS = [
        'file_hash' => [
            'type' => 'string',
            'required' => true,
            'description' => 'SHA256 hash of file',
        ],
        'password' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The password to use to encrypt the ZIP file. Using a password is mandatory, the default password is urlscan!',
        ],
        'filename' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Specify the name of the ZIP file that should be downloaded. This does not change the name of files within the ZIP archive. The default filename is $fileHash.zip',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/downloads/{fileHash}';
    protected const PATH_PARAMS = [
        'fileHash' => 'file_hash',
    ];
    protected const QUERY_PARAMS = [
        'password' => 'password',
        'filename' => 'filename',
    ];
    protected const BODY_REQUIRED = false;
}

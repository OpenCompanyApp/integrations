<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Download a single batch file.
 *
 * Executes the official Avalara AvaTax REST API operation DownloadBatch.
 */
class AvalaraDownloadBatch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_download_batch';
}
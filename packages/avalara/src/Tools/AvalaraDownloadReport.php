<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Download a report.
 *
 * Executes the official Avalara AvaTax REST API operation DownloadReport.
 */
class AvalaraDownloadReport extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_download_report';
}
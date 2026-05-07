<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Download a file listing tax rates by postal code.
 *
 * Executes the official Avalara AvaTax REST API operation DownloadTaxRatesByZipCode.
 */
class AvalaraDownloadTaxRatesByZipCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_download_tax_rates_by_zip_code';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Download an image for this certificate.
 *
 * Executes the official Avalara AvaTax REST API operation DownloadCertificateImage.
 */
class AvalaraDownloadCertificateImage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_download_certificate_image';
}
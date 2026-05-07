<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Upload an image or PDF attachment for this certificate.
 *
 * Executes the official Avalara AvaTax REST API operation UploadCertificateImage.
 */
class AvalaraUploadCertificateImage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_upload_certificate_image';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Upload an image for an item..
 *
 * Executes the official Avalara AvaTax REST API operation UploadImage.
 */
class AvalaraUploadImage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_upload_image';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update an existing image for an item..
 *
 * Executes the official Avalara AvaTax REST API operation UpdateImage.
 */
class AvalaraUpdateImage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_image';
}
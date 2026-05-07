<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get the image associated with an item..
 *
 * Executes the official Avalara AvaTax REST API operation GetProductImage.
 */
class AvalaraGetProductImage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_product_image';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete the image associated with an item..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteItemImage.
 */
class AvalaraDeleteItemImage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_item_image';
}
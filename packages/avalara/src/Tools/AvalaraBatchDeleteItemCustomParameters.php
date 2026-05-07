<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete all custom parameters for an item.
 *
 * Executes the official Avalara AvaTax REST API operation BatchDeleteItemCustomParameters.
 */
class AvalaraBatchDeleteItemCustomParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_batch_delete_item_custom_parameters';
}
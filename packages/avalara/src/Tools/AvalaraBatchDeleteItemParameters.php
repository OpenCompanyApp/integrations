<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete all parameters for an item.
 *
 * Executes the official Avalara AvaTax REST API operation BatchDeleteItemParameters.
 */
class AvalaraBatchDeleteItemParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_batch_delete_item_parameters';
}
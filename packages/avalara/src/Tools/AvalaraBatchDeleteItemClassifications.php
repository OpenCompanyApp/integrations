<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete all classifications for an item.
 *
 * Executes the official Avalara AvaTax REST API operation BatchDeleteItemClassifications.
 */
class AvalaraBatchDeleteItemClassifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_batch_delete_item_classifications';
}
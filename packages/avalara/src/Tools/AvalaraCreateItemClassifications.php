<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add classifications to an item..
 *
 * Executes the official Avalara AvaTax REST API operation CreateItemClassifications.
 */
class AvalaraCreateItemClassifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_item_classifications';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add custom parameters to an item..
 *
 * Executes the official Avalara AvaTax REST API operation CreateItemCustomParameters.
 */
class AvalaraCreateItemCustomParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_item_custom_parameters';
}
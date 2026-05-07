<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add parameters to an item..
 *
 * Executes the official Avalara AvaTax REST API operation CreateItemParameters.
 */
class AvalaraCreateItemParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_item_parameters';
}
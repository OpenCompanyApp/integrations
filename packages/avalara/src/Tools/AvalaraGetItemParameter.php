<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single item parameter.
 *
 * Executes the official Avalara AvaTax REST API operation GetItemParameter.
 */
class AvalaraGetItemParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_item_parameter';
}
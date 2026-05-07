<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single item custom parameter.
 *
 * Executes the official Avalara AvaTax REST API operation GetItemCustomParameter.
 */
class AvalaraGetItemCustomParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_item_custom_parameter';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update an item custom parameter.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateItemCustomParameter.
 */
class AvalaraUpdateItemCustomParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_item_custom_parameter';
}
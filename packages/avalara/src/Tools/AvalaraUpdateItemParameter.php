<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update an item parameter.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateItemParameter.
 */
class AvalaraUpdateItemParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_item_parameter';
}
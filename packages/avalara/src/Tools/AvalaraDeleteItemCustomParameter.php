<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single item custom parameter.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteItemCustomParameter.
 */
class AvalaraDeleteItemCustomParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_item_custom_parameter';
}
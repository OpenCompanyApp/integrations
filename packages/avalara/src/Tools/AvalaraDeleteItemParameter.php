<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single item parameter.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteItemParameter.
 */
class AvalaraDeleteItemParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_item_parameter';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single item.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteItem.
 */
class AvalaraDeleteItem extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_item';
}
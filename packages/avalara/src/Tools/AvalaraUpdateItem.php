<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single item.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateItem.
 */
class AvalaraUpdateItem extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_item';
}
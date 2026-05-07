<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List of all possible status which can be assigned to an item.
 *
 * Executes the official Avalara AvaTax REST API operation ListItemsStatus.
 */
class AvalaraListItemsStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_items_status';
}
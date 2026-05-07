<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve parameters for an item.
 *
 * Executes the official Avalara AvaTax REST API operation ListItemParameters.
 */
class AvalaraListItemParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_item_parameters';
}
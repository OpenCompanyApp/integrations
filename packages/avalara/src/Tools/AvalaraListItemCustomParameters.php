<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve custom parameters for an item.
 *
 * Executes the official Avalara AvaTax REST API operation ListItemCustomParameters.
 */
class AvalaraListItemCustomParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_item_custom_parameters';
}
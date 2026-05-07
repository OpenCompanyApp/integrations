<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve classifications for an item..
 *
 * Executes the official Avalara AvaTax REST API operation ListItemClassifications.
 */
class AvalaraListItemClassifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_item_classifications';
}
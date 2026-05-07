<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve tags for an item.
 *
 * Executes the official Avalara AvaTax REST API operation GetItemTags.
 */
class AvalaraGetItemTags extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_item_tags';
}
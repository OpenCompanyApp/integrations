<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create tags for a item.
 *
 * Executes the official Avalara AvaTax REST API operation CreateItemTags.
 */
class AvalaraCreateItemTags extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_item_tags';
}
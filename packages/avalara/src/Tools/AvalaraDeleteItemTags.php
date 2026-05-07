<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete all item tags.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteItemTags.
 */
class AvalaraDeleteItemTags extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_item_tags';
}
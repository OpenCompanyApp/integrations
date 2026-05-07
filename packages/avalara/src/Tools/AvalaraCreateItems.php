<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new item.
 *
 * Executes the official Avalara AvaTax REST API operation CreateItems.
 */
class AvalaraCreateItems extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_items';
}
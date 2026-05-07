<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single item.
 *
 * Executes the official Avalara AvaTax REST API operation GetItem.
 */
class AvalaraGetItem extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_item';
}
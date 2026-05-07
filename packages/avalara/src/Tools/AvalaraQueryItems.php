<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all items.
 *
 * Executes the official Avalara AvaTax REST API operation QueryItems.
 */
class AvalaraQueryItems extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_items';
}
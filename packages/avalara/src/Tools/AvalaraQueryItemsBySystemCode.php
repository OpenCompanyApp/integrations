<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve items for this company based on System Code and filter criteria(optional) provided.
 *
 * Executes the official Avalara AvaTax REST API operation QueryItemsBySystemCode.
 */
class AvalaraQueryItemsBySystemCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_items_by_system_code';
}
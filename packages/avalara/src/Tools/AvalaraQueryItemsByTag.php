<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all items associated with given tag.
 *
 * Executes the official Avalara AvaTax REST API operation QueryItemsByTag.
 */
class AvalaraQueryItemsByTag extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_items_by_tag';
}
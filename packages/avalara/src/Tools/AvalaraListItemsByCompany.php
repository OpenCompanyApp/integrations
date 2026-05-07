<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve items for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListItemsByCompany.
 */
class AvalaraListItemsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_items_by_company';
}
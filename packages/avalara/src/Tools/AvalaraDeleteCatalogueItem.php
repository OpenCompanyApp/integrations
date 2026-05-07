<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single item.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCatalogueItem.
 */
class AvalaraDeleteCatalogueItem extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_catalogue_item';
}
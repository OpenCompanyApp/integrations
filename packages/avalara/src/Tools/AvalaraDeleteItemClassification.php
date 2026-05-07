<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single item classification..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteItemClassification.
 */
class AvalaraDeleteItemClassification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_item_classification';
}
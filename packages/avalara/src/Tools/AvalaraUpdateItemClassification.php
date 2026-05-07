<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update an item classification..
 *
 * Executes the official Avalara AvaTax REST API operation UpdateItemClassification.
 */
class AvalaraUpdateItemClassification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_item_classification';
}
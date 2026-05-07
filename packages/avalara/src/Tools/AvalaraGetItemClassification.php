<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single item classification..
 *
 * Executes the official Avalara AvaTax REST API operation GetItemClassification.
 */
class AvalaraGetItemClassification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_item_classification';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all available product classification systems..
 *
 * Executes the official Avalara AvaTax REST API operation ListProductClassificationSystems.
 */
class AvalaraListProductClassificationSystems extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_product_classification_systems';
}
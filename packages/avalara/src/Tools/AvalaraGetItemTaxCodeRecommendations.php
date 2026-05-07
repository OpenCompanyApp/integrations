<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get Item TaxCode Recommendations.
 *
 * Executes the official Avalara AvaTax REST API operation GetItemTaxCodeRecommendations.
 */
class AvalaraGetItemTaxCodeRecommendations extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_item_tax_code_recommendations';
}
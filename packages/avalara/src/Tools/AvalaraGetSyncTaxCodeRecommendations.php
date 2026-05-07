<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get the real-time tax code recommendations for the specified items without saving item data..
 *
 * Executes the official Avalara AvaTax REST API operation GetSyncTaxCodeRecommendations.
 */
class AvalaraGetSyncTaxCodeRecommendations extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_sync_tax_code_recommendations';
}
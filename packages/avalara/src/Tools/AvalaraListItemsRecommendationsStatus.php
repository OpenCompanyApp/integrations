<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List of all recommendation status which can be assigned to an item.
 *
 * Executes the official Avalara AvaTax REST API operation ListItemsRecommendationsStatus.
 */
class AvalaraListItemsRecommendationsStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_items_recommendations_status';
}
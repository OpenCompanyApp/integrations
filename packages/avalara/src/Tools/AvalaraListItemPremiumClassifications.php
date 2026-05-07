<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve premium classification for an item based on its `companyId` and `itemCode`..
 *
 * Executes the official Avalara AvaTax REST API operation ListItemPremiumClassifications.
 */
class AvalaraListItemPremiumClassifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_item_premium_classifications';
}
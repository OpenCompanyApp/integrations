<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List of all HS code classification statuses that can be assigned to an Item..
 *
 * Executes the official Avalara AvaTax REST API operation ListItemHSCodeClassificationStatus.
 */
class AvalaraListItemHSCodeClassificationStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_item_hs_code_classification_status';
}
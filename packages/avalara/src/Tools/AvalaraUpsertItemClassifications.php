<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add/update item classifications..
 *
 * Executes the official Avalara AvaTax REST API operation UpsertItemClassifications.
 */
class AvalaraUpsertItemClassifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_upsert_item_classifications';
}
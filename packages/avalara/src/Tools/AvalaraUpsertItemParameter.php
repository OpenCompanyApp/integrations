<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add/update an item parameter..
 *
 * Executes the official Avalara AvaTax REST API operation UpsertItemParameter.
 */
class AvalaraUpsertItemParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_upsert_item_parameter';
}
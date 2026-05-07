<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add/update an item custom parameter.
 *
 * Executes the official Avalara AvaTax REST API operation UpsertItemCustomParameter.
 */
class AvalaraUpsertItemCustomParameter extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_upsert_item_custom_parameter';
}
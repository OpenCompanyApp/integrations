<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete item tag by id.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteItemTag.
 */
class AvalaraDeleteItemTag extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_item_tag';
}
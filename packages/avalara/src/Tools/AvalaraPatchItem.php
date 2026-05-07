<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Patch a single item.
 *
 * Executes the official Avalara AvaTax REST API operation PatchItem.
 */
class AvalaraPatchItem extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_patch_item';
}
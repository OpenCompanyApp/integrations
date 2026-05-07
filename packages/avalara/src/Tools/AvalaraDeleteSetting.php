<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single setting.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteSetting.
 */
class AvalaraDeleteSetting extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_setting';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single setting.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateSetting.
 */
class AvalaraUpdateSetting extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_setting';
}
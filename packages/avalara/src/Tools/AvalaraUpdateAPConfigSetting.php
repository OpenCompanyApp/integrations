<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a AP config setting.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateAPConfigSetting.
 */
class AvalaraUpdateAPConfigSetting extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_ap_config_setting';
}
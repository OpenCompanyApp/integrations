<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create new rule.
 *
 * Executes the official Avalara AvaTax REST API operation CreateAPConfigSetting.
 */
class AvalaraCreateAPConfigSetting extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_ap_config_setting';
}
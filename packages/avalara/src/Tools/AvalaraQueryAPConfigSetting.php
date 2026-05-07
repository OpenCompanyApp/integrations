<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all rules.
 *
 * Executes the official Avalara AvaTax REST API operation QueryAPConfigSetting.
 */
class AvalaraQueryAPConfigSetting extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_ap_config_setting';
}
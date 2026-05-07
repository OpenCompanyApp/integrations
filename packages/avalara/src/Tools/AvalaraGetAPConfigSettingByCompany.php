<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve rule for this company.
 *
 * Executes the official Avalara AvaTax REST API operation GetAPConfigSettingByCompany.
 */
class AvalaraGetAPConfigSettingByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_ap_config_setting_by_company';
}
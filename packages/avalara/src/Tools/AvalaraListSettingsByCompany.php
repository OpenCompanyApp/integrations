<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all settings for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListSettingsByCompany.
 */
class AvalaraListSettingsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_settings_by_company';
}
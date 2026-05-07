<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single setting.
 *
 * Executes the official Avalara AvaTax REST API operation GetSetting.
 */
class AvalaraGetSetting extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_setting';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all settings.
 *
 * Executes the official Avalara AvaTax REST API operation QuerySettings.
 */
class AvalaraQuerySettings extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_settings';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new setting.
 *
 * Executes the official Avalara AvaTax REST API operation CreateSettings.
 */
class AvalaraCreateSettings extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_settings';
}
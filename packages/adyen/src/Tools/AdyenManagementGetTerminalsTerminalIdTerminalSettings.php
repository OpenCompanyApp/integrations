<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get terminal settings.
 *
 * Executes the official Adyen management API operation get-terminals-terminalId-terminalSettings.
 */
class AdyenManagementGetTerminalsTerminalIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_terminals_terminal_id_terminal_settings';
}

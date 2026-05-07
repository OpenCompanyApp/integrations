<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get the terminal logo.
 *
 * Executes the official Adyen management API operation get-terminals-terminalId-terminalLogos.
 */
class AdyenManagementGetTerminalsTerminalIdTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_terminals_terminal_id_terminal_logos';
}

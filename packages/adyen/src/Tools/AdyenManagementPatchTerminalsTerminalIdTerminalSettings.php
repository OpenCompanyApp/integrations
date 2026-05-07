<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update terminal settings.
 *
 * Executes the official Adyen management API operation patch-terminals-terminalId-terminalSettings.
 */
class AdyenManagementPatchTerminalsTerminalIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_terminals_terminal_id_terminal_settings';
}

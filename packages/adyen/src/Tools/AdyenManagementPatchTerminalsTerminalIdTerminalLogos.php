<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the logo.
 *
 * Executes the official Adyen management API operation patch-terminals-terminalId-terminalLogos.
 */
class AdyenManagementPatchTerminalsTerminalIdTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_terminals_terminal_id_terminal_logos';
}

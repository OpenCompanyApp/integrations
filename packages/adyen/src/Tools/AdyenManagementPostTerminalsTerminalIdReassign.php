<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Reassign a terminal.
 *
 * Executes the official Adyen management API operation post-terminals-terminalId-reassign.
 */
class AdyenManagementPostTerminalsTerminalIdReassign extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_terminals_terminal_id_reassign';
}

<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call Actions -- Hang up.
 *
 * Executes the official Dialpad API operation call.actions.hangup.
 */
class DialpadCallActionsHangup extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_call_actions_hangup';
}

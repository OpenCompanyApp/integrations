<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Call Recording -- Toggle.
 *
 * Executes the official Dialpad API operation users.update_active_call.
 */
class DialpadUsersUpdateActiveCall extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_users_update_active_call';
}

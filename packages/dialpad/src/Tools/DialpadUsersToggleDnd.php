<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Do Not Disturb -- Toggle.
 *
 * Executes the official Dialpad API operation users.toggle_dnd.
 */
class DialpadUsersToggleDnd extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_users_toggle_dnd';
}

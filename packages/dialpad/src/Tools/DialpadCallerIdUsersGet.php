<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Caller ID -- Get.
 *
 * Executes the official Dialpad API operation caller_id.users.get.
 */
class DialpadCallerIdUsersGet extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_caller_id_users_get';
}

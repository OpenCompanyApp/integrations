<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get current user.
 *
 * Executes the official Box API operation get_users_me.
 */
class BoxGetUsersMe extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_users_me';
}

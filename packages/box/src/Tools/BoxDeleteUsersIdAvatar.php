<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Delete user avatar.
 *
 * Executes the official Box API operation delete_users_id_avatar.
 */
class BoxDeleteUsersIdAvatar extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_users_id_avatar';
}

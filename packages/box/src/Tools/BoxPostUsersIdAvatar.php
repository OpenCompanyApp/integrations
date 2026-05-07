<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Add or update user avatar.
 *
 * Executes the official Box API operation post_users_id_avatar.
 */
class BoxPostUsersIdAvatar extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_users_id_avatar';
}

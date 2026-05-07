<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create email alias.
 *
 * Executes the official Box API operation post_users_id_email_aliases.
 */
class BoxPostUsersIdEmailAliases extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_users_id_email_aliases';
}

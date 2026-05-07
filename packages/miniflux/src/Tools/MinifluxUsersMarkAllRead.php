<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Mark all entries for one user as read.
 */
class MinifluxUsersMarkAllRead extends AbstractMinifluxTool
{
    protected const OPERATION = 'users_mark_all_read';
}

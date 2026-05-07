<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create jobs to terminate users session.
 *
 * Executes the official Box API operation post_users_terminate_sessions.
 */
class BoxPostUsersTerminateSessions extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_users_terminate_sessions';
}

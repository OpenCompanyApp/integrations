<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create jobs to terminate user group session.
 *
 * Executes the official Box API operation post_groups_terminate_sessions.
 */
class BoxPostGroupsTerminateSessions extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_groups_terminate_sessions';
}

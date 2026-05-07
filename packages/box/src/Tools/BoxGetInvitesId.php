<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get user invite status.
 *
 * Executes the official Box API operation get_invites_id.
 */
class BoxGetInvitesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_invites_id';
}

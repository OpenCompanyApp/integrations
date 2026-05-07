<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create user invite.
 *
 * Executes the official Box API operation post_invites.
 */
class BoxPostInvites extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_invites';
}

<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Get a post thread.
 *
 * Retrieves a thread by root post ID.
 */
class MattermostGetPostThread extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_get_post_thread';
    protected const DESCRIPTION = 'Get a Mattermost post thread by root post ID.';
    protected const PARAMETERS = [
        'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Root post ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/posts/{post_id}/thread';
    protected const REQUIRED = ['post_id'];
}

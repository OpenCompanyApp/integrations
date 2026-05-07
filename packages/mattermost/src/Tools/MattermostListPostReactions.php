<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * List reactions for a Mattermost post.
 *
 * Retrieves all reactions attached to a post.
 */
class MattermostListPostReactions extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_list_post_reactions';
    protected const DESCRIPTION = 'List reactions for a Mattermost post.';
    protected const PARAMETERS = [
        'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Post ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/posts/{post_id}/reactions';
    protected const REQUIRED = ['post_id'];
}

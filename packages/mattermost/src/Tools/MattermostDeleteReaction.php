<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Delete a Mattermost reaction.
 *
 * Removes one emoji reaction from a post.
 */
class MattermostDeleteReaction extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_delete_reaction';
    protected const DESCRIPTION = 'Delete a Mattermost reaction from a post.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID that created the reaction.'],
        'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Post ID.'],
        'emoji_name' => ['type' => 'string', 'required' => true, 'description' => 'Emoji name.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/users/{user_id}/posts/{post_id}/reactions/{emoji_name}';
    protected const REQUIRED = ['user_id', 'post_id', 'emoji_name'];
}

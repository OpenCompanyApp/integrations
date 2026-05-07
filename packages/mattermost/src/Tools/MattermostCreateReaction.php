<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Create a Mattermost reaction.
 *
 * Adds an emoji reaction to a post.
 */
class MattermostCreateReaction extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_create_reaction';
    protected const DESCRIPTION = 'Add an emoji reaction to a Mattermost post.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID creating the reaction.'],
        'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Post ID.'],
        'emoji_name' => ['type' => 'string', 'required' => true, 'description' => 'Emoji name.'],
        'body' => ['type' => 'object', 'description' => 'Raw reaction body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/reactions';
    protected const REQUIRED = ['user_id', 'post_id', 'emoji_name'];
    protected const BODY_KEYS = ['user_id', 'post_id', 'emoji_name'];
    protected const BODY_REQUIRED = true;
}

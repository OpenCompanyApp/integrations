<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Delete a Mattermost post.
 *
 * Deletes a post by ID.
 */
class MattermostDeletePost extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_delete_post';
    protected const DESCRIPTION = 'Delete a Mattermost post by post_id.';
    protected const PARAMETERS = [
        'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Post ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/posts/{post_id}';
    protected const REQUIRED = ['post_id'];
}

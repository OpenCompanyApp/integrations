<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Patch a Mattermost post.
 *
 * Updates message content, props, or metadata for a post.
 */
class MattermostPatchPost extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_patch_post';
    protected const DESCRIPTION = 'Patch a Mattermost post. Provide message, props, file_ids, or raw body.';
    protected const PARAMETERS = [
        'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Post ID.'],
        'message' => ['type' => 'string', 'description' => 'Updated message.'],
        'props' => ['type' => 'object', 'description' => 'Post props.'],
        'file_ids' => ['type' => 'array', 'description' => 'Attached file IDs.'],
        'body' => ['type' => 'object', 'description' => 'Raw post patch body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/posts/{post_id}/patch';
    protected const REQUIRED = ['post_id'];
    protected const BODY_KEYS = ['message', 'props', 'file_ids'];
    protected const BODY_REQUIRED = true;
}

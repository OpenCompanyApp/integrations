<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Like a Bluesky post.
 */
class BlueskyLikePost extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_like_post';
    protected const DESCRIPTION = 'Like a post by creating an app.bsky.feed.like record.';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => true, 'description' => 'Post AT URI.'],
        'cid' => ['type' => 'string', 'required' => true, 'description' => 'Post CID.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->likePost($this->stringArg($args, 'uri'), $this->stringArg($args, 'cid'));
    }
}

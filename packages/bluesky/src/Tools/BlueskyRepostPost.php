<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Repost a Bluesky post.
 */
class BlueskyRepostPost extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_repost_post';
    protected const DESCRIPTION = 'Repost a post by creating an app.bsky.feed.repost record.';
    protected const PARAMETERS = [
        'uri' => ['type' => 'string', 'required' => true, 'description' => 'Post AT URI.'],
        'cid' => ['type' => 'string', 'required' => true, 'description' => 'Post CID.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->repostPost($this->stringArg($args, 'uri'), $this->stringArg($args, 'cid'));
    }
}

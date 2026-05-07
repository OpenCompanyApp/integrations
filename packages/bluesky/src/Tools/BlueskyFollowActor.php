<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

/**
 * Follow a Bluesky actor.
 */
class BlueskyFollowActor extends AbstractBlueskyTool
{
    protected const NAME = 'bluesky_follow_actor';
    protected const DESCRIPTION = 'Follow an actor DID by creating an app.bsky.graph.follow record.';
    protected const PARAMETERS = [
        'subject' => ['type' => 'string', 'required' => true, 'description' => 'Actor DID to follow.'],
    ];

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->followActor($this->stringArg($args, 'subject'));
    }
}

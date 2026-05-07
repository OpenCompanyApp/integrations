<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Delete a Missive post.
 */
class MissiveDeletePost extends AbstractMissiveTool
{
    public const NAME = 'missive_delete_post';
    public const DESCRIPTION = 'Delete a Missive post by ID.';
    public const PARAMETERS = [
        'post_id' => ['type' => 'string', 'required' => true, 'description' => 'Post UUID.'],
    ];

    /**
     * Delete a post.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deletePost($this->requiredString($args, 'post_id', 'post_id'));
    }
}

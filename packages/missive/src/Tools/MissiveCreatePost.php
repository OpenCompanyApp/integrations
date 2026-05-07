<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Create a Missive post in a conversation.
 */
class MissiveCreatePost extends AbstractMissiveTool
{
    public const NAME = 'missive_create_post';
    public const DESCRIPTION = 'Create a Missive post in a conversation.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Post payload matching the Missive posts endpoint.'],
    ];

    /**
     * Create a post.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->createPost($body);
    }
}

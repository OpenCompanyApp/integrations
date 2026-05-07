<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List posts in a Missive conversation.
 */
class MissiveListConversationPosts extends AbstractMissiveTool
{
    public const NAME = 'missive_list_conversation_posts';
    public const DESCRIPTION = 'List posts in a Missive conversation with timestamp pagination.';
    public const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation UUID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as limit and until.'],
    ];

    /**
     * List conversation posts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listConversationPosts($this->requiredString($args, 'conversation_id', 'conversation_id'), $this->arrayArg($args, 'params'));
    }
}

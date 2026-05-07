<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List comments in a Missive conversation.
 */
class MissiveListConversationComments extends AbstractMissiveTool
{
    public const NAME = 'missive_list_conversation_comments';
    public const DESCRIPTION = 'List comments in a Missive conversation with timestamp pagination.';
    public const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation UUID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as limit and until.'],
    ];

    /**
     * List conversation comments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listConversationComments($this->requiredString($args, 'conversation_id', 'conversation_id'), $this->arrayArg($args, 'params'));
    }
}

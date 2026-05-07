<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List messages in a Missive conversation.
 */
class MissiveListConversationMessages extends AbstractMissiveTool
{
    public const NAME = 'missive_list_conversation_messages';
    public const DESCRIPTION = 'List messages in a Missive conversation with timestamp pagination.';
    public const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation UUID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as limit and until.'],
    ];

    /**
     * List conversation messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listConversationMessages($this->requiredString($args, 'conversation_id', 'conversation_id'), $this->arrayArg($args, 'params'));
    }
}

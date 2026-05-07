<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Merge one Missive conversation into another.
 */
class MissiveMergeConversation extends AbstractMissiveTool
{
    public const NAME = 'missive_merge_conversation';
    public const DESCRIPTION = 'Merge a source Missive conversation into a target conversation.';
    public const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Source conversation UUID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Merge payload including target and optional subject.'],
    ];

    /**
     * Merge a conversation.
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

        return $this->service->mergeConversation($this->requiredString($args, 'conversation_id', 'conversation_id'), $body);
    }
}

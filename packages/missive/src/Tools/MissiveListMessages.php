<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Search Missive messages by documented message parameters.
 */
class MissiveListMessages extends AbstractMissiveTool
{
    public const NAME = 'missive_list_messages';
    public const DESCRIPTION = 'List Missive messages using documented query parameters such as email_message_id.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as email_message_id.'],
    ];

    /**
     * List messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listMessages($this->arrayArg($args, 'params'));
    }
}

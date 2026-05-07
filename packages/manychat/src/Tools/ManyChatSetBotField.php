<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Set a Manychat bot field value by ID.
 */
class ManyChatSetBotField extends AbstractManyChatTool
{
    public const NAME = 'manychat_set_bot_field';
    public const DESCRIPTION = 'Set a bot field value by field ID.';
    public const PARAMETERS = [
        'field_id' => ['type' => 'integer', 'required' => true, 'description' => 'Bot field ID.'],
        'field_value' => ['type' => 'string', 'required' => true, 'description' => 'Field value.'],
    ];

    /**
     * Set the bot field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->setBotField($this->requiredInt($args, 'field_id'), $this->requiredValue($args, 'field_value'));
    }
}

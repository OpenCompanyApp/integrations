<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * List Manychat bot fields.
 */
class ManyChatListBotFields extends AbstractManyChatTool
{
    public const NAME = 'manychat_list_bot_fields';
    public const DESCRIPTION = 'List bot fields configured in the Manychat bot.';
    public const PARAMETERS = [];

    /**
     * List bot fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listBotFields();
    }
}

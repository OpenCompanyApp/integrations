<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * List Manychat custom user fields.
 */
class ManyChatListCustomFields extends AbstractManyChatTool
{
    public const NAME = 'manychat_list_custom_fields';
    public const DESCRIPTION = 'List custom user fields available for subscriber segmentation and updates.';
    public const PARAMETERS = [];

    /**
     * List custom fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listCustomFields();
    }
}

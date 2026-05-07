<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Remove a Manychat tag by name.
 */
class ManyChatRemoveTagByName extends AbstractManyChatTool
{
    public const NAME = 'manychat_remove_tag_by_name';
    public const DESCRIPTION = 'Remove a tag from the Manychat bot by tag name.';
    public const PARAMETERS = [
        'tag_name' => ['type' => 'string', 'required' => true, 'description' => 'Tag name.'],
    ];

    /**
     * Remove the tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->removeTagByName($this->requiredString($args, 'tag_name'));
    }
}

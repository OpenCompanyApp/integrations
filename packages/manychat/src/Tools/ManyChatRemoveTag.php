<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Remove a Manychat tag by ID.
 */
class ManyChatRemoveTag extends AbstractManyChatTool
{
    public const NAME = 'manychat_remove_tag';
    public const DESCRIPTION = 'Remove a tag from the Manychat bot by tag ID.';
    public const PARAMETERS = [
        'tag_id' => ['type' => 'integer', 'required' => true, 'description' => 'Tag ID.'],
    ];

    /**
     * Remove the tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->removeTag($this->requiredInt($args, 'tag_id'));
    }
}

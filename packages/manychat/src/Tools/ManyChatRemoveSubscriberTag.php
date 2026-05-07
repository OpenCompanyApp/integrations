<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Remove a tag from a Manychat subscriber.
 */
class ManyChatRemoveSubscriberTag extends AbstractManyChatTool
{
    public const NAME = 'manychat_remove_subscriber_tag';
    public const DESCRIPTION = 'Remove a tag from a subscriber by tag ID.';
    public const PARAMETERS = [
        'subscriber_id' => ['type' => 'integer', 'required' => true, 'description' => 'Subscriber ID.'],
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
        return $this->service->removeSubscriberTag(
            $this->requiredInt($args, 'subscriber_id'),
            $this->requiredInt($args, 'tag_id')
        );
    }
}

<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Add a tag to a Manychat subscriber.
 */
class ManyChatAddSubscriberTag extends AbstractManyChatTool
{
    public const NAME = 'manychat_add_subscriber_tag';
    public const DESCRIPTION = 'Add a tag to a subscriber by tag ID.';
    public const PARAMETERS = [
        'subscriber_id' => ['type' => 'integer', 'required' => true, 'description' => 'Subscriber ID.'],
        'tag_id' => ['type' => 'integer', 'required' => true, 'description' => 'Tag ID.'],
    ];

    /**
     * Add the tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->addSubscriberTag(
            $this->requiredInt($args, 'subscriber_id'),
            $this->requiredInt($args, 'tag_id')
        );
    }
}

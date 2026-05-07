<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Find Manychat subscribers by name.
 */
class ManyChatFindSubscriberByName extends AbstractManyChatTool
{
    public const NAME = 'manychat_find_subscriber_by_name';
    public const DESCRIPTION = 'Find subscribers by name.';
    public const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber name search value.'],
    ];

    /**
     * Find subscribers.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->findSubscriberByName($this->requiredString($args, 'name'));
    }
}

<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Set a Manychat subscriber custom field value.
 */
class ManyChatSetSubscriberCustomField extends AbstractManyChatTool
{
    public const NAME = 'manychat_set_subscriber_custom_field';
    public const DESCRIPTION = 'Set one custom field on a subscriber by field ID.';
    public const PARAMETERS = [
        'subscriber_id' => ['type' => 'integer', 'required' => true, 'description' => 'Subscriber ID.'],
        'field_id' => ['type' => 'integer', 'required' => true, 'description' => 'Custom field ID.'],
        'field_value' => ['type' => 'string', 'required' => true, 'description' => 'Field value.'],
    ];

    /**
     * Set the custom field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->setSubscriberCustomField(
            $this->requiredInt($args, 'subscriber_id'),
            $this->requiredInt($args, 'field_id'),
            $this->requiredValue($args, 'field_value')
        );
    }
}

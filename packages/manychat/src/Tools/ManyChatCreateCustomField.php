<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

/**
 * Create a Manychat custom user field.
 */
class ManyChatCreateCustomField extends AbstractManyChatTool
{
    public const NAME = 'manychat_create_custom_field';
    public const DESCRIPTION = 'Create a Manychat custom user field.';
    public const PARAMETERS = [
        'caption' => ['type' => 'string', 'required' => true, 'description' => 'Field caption.'],
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Field type: text, number, date, datetime, boolean, or array when supported.'],
        'description' => ['type' => 'string', 'description' => 'Optional field description.'],
    ];

    /**
     * Create the custom field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $data = [
            'caption' => $this->requiredString($args, 'caption'),
            'type' => $this->requiredString($args, 'type'),
        ];

        if (isset($args['description'])) {
            $data['description'] = (string) $args['description'];
        }

        return $this->service->createCustomField($data);
    }
}

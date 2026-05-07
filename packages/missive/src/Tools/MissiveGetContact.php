<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Get a Missive contact by ID.
 */
class MissiveGetContact extends AbstractMissiveTool
{
    public const NAME = 'missive_get_contact';
    public const DESCRIPTION = 'Get a Missive contact by ID.';
    public const PARAMETERS = [
        'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact UUID.'],
    ];

    /**
     * Get a contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getContact($this->requiredString($args, 'contact_id', 'contact_id'));
    }
}

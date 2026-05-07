<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Update one or more Missive contacts.
 */
class MissiveUpdateContacts extends AbstractMissiveTool
{
    public const NAME = 'missive_update_contacts';
    public const DESCRIPTION = 'Update one or more Missive contacts by comma-separated contact IDs.';
    public const PARAMETERS = [
        'contact_ids' => ['type' => 'string', 'required' => true, 'description' => 'One or more contact IDs, comma separated.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Contact attributes to update.'],
    ];

    /**
     * Update contacts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->updateContacts($this->requiredString($args, 'contact_ids', 'contact_ids'), $body);
    }
}

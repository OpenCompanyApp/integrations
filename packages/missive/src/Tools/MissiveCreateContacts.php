<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * Create one or more Missive contacts.
 */
class MissiveCreateContacts extends AbstractMissiveTool
{
    public const NAME = 'missive_create_contacts';
    public const DESCRIPTION = 'Create one or more Missive contacts.';
    public const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Contact creation payload.'],
    ];

    /**
     * Create contacts.
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

        return $this->service->createContacts($body);
    }
}

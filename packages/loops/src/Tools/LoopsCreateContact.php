<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Create a new Loops contact.
 *
 * Accepts default and custom contact properties supported by Loops.
 */
class LoopsCreateContact extends AbstractLoopsTool
{
    protected const NAME = 'loops_create_contact';
    protected const DESCRIPTION = 'Create a Loops contact with an email address and optional default or custom contact properties.';
    protected const METHOD = 'createContact';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'required' => true, 'description' => 'The contact email address.'],
        'firstName' => ['type' => 'string', 'description' => 'The contact first name.'],
        'lastName' => ['type' => 'string', 'description' => 'The contact last name.'],
        'userId' => ['type' => 'string', 'description' => 'Your unique user ID for the contact.'],
        'source' => ['type' => 'string', 'description' => 'The source label for the contact.'],
        'subscribed' => ['type' => 'boolean', 'description' => 'Whether the contact should receive campaign and loop emails.'],
        'mailingLists' => ['type' => 'object', 'description' => 'Mailing list IDs mapped to true for subscriptions.'],
        'properties' => ['type' => 'object', 'description' => 'Additional custom contact properties using Loops property names.'],
    ];

    /**
     * Create the contact.
     *
     * @param  array<string, mixed>  $args  Contact fields.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createContact($this->mergeProperties($args));
    }
}

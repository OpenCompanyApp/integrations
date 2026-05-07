<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Update or create a Loops contact.
 *
 * Identifies the contact by email or userId and applies default or custom
 * property updates.
 */
class LoopsUpdateContact extends AbstractLoopsTool
{
    protected const NAME = 'loops_update_contact';
    protected const DESCRIPTION = 'Update or create a Loops contact by email or userId with default or custom contact properties.';
    protected const METHOD = 'updateContact';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'description' => 'The contact email address. Provide email or userId.'],
        'userId' => ['type' => 'string', 'description' => 'Your unique user ID. Provide email or userId.'],
        'firstName' => ['type' => 'string', 'description' => 'The contact first name.'],
        'lastName' => ['type' => 'string', 'description' => 'The contact last name.'],
        'source' => ['type' => 'string', 'description' => 'The source label for the contact.'],
        'subscribed' => ['type' => 'boolean', 'description' => 'Whether the contact should receive campaign and loop emails.'],
        'mailingLists' => ['type' => 'object', 'description' => 'Mailing list IDs mapped to true or false to subscribe or unsubscribe.'],
        'properties' => ['type' => 'object', 'description' => 'Additional custom contact properties using Loops property names.'],
    ];

    /**
     * Update the contact.
     *
     * @param  array<string, mixed>  $args  Contact update fields.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->updateContact($this->mergeProperties($args));
    }
}

<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Delete a Loops contact by email or user ID.
 *
 * The contact is removed from the audience according to Loops API behavior.
 */
class LoopsDeleteContact extends AbstractLoopsTool
{
    protected const NAME = 'loops_delete_contact';
    protected const DESCRIPTION = 'Delete a Loops contact by email address or userId.';
    protected const METHOD = 'deleteContact';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'description' => 'The contact email address. Provide exactly one of email or userId.'],
        'userId' => ['type' => 'string', 'description' => 'Your unique user ID. Provide exactly one of email or userId.'],
    ];
}

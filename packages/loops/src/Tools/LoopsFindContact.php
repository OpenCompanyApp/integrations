<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Find Loops contacts by email or user ID.
 *
 * The API returns an array and returns an empty array when no contact matches.
 */
class LoopsFindContact extends AbstractLoopsTool
{
    protected const NAME = 'loops_find_contact';
    protected const DESCRIPTION = 'Find a Loops contact by email address or userId.';
    protected const METHOD = 'findContact';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'description' => 'The contact email address. Provide exactly one of email or userId.'],
        'userId' => ['type' => 'string', 'description' => 'Your unique user ID. Provide exactly one of email or userId.'],
    ];
}

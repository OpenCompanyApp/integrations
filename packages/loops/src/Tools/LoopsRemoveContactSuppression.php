<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Remove a Loops contact from the suppression list.
 *
 * This endpoint is quota-limited by Loops.
 */
class LoopsRemoveContactSuppression extends AbstractLoopsTool
{
    protected const NAME = 'loops_remove_contact_suppression';
    protected const DESCRIPTION = 'Remove a Loops contact from suppression by email address or userId.';
    protected const METHOD = 'removeContactSuppression';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'description' => 'The contact email address. Provide exactly one of email or userId.'],
        'userId' => ['type' => 'string', 'description' => 'Your unique user ID. Provide exactly one of email or userId.'],
    ];
}

<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Check whether a Loops contact is suppressed.
 *
 * Returns suppression status and the suppression removal quota.
 */
class LoopsCheckContactSuppression extends AbstractLoopsTool
{
    protected const NAME = 'loops_check_contact_suppression';
    protected const DESCRIPTION = 'Check whether a Loops contact is suppressed by email address or userId.';
    protected const METHOD = 'checkContactSuppression';
    protected const PARAMETERS = [
        'email' => ['type' => 'string', 'description' => 'The contact email address. Provide exactly one of email or userId.'],
        'userId' => ['type' => 'string', 'description' => 'Your unique user ID. Provide exactly one of email or userId.'],
    ];
}

<?php

namespace OpenCompany\Integrations\Loops\Tools;

/**
 * Send an event to Loops.
 *
 * Events can trigger automations and include event properties for
 * personalization.
 */
class LoopsSendEvent extends AbstractLoopsTool
{
    protected const NAME = 'loops_send_event';
    protected const DESCRIPTION = 'Send a Loops event by eventName for a contact identified by email or userId.';
    protected const METHOD = 'sendEvent';
    protected const PARAMETERS = [
        'eventName' => ['type' => 'string', 'required' => true, 'description' => 'The Loops event name.'],
        'email' => ['type' => 'string', 'description' => 'The contact email address. Provide email or userId.'],
        'userId' => ['type' => 'string', 'description' => 'Your unique user ID. Provide email or userId.'],
        'eventProperties' => ['type' => 'object', 'description' => 'Optional event properties.'],
    ];
}

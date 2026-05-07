<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

/**
 * Screen-pop -- Trigger.
 *
 * Executes the official Dialpad API operation screen_pop.initiate.
 */
class DialpadScreenPopInitiate extends AbstractDialpadOperationTool
{
    protected const OPERATION = 'dialpad_screen_pop_initiate';
}

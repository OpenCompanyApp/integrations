<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List user and enterprise events.
 *
 * Executes the official Box API operation get_events.
 */
class BoxGetEvents extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_events';
}

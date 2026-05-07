<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Fetch the status of a message you've previously sent.
 */
class CourierMessagesGet extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_messages_get';
}

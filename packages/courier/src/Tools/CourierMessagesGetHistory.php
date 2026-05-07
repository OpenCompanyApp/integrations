<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Fetch the array of events of a message you've previously sent.
 */
class CourierMessagesGetHistory extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_messages_get_history';
}

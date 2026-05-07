<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Cancel a message that is currently in the process of being delivered.
 */
class CourierMessagesCancel extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_messages_cancel';
}

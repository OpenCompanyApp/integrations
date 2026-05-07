<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Fetch the statuses of messages you've previously sent.
 */
class CourierMessagesList extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_messages_list';
}

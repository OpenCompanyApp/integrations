<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Subscribes additional users to the list, without modifying existing subscriptions.
 */
class CourierListsAddSubscribers extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_lists_add_subscribers';
}

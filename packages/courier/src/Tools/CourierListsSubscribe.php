<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).
 */
class CourierListsSubscribe extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_lists_subscribe';
}

<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * This endpoint returns a list of "activities" for people, similar to your workspace's Activity Logs.
 */
class CustomerIOAppListActivities extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_list_activities';
}

<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Unsubscribe from Notifications.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/notifications/unsubscribe/.
 */
class DbtCloudV2UnsubscribeFromNotifications extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_unsubscribe_from_notifications';
    protected const DESCRIPTION = 'Unsubscribe from Notifications

Official dbt Cloud v2 endpoint: POST /api/v2/notifications/unsubscribe/

Clear out all email notification configurations for the user making the request.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v2/notifications/unsubscribe/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Update an Ashby application. */
class AshbyUpdateApplication extends AbstractAshbyTool
{
    protected const NAME = 'ashby_update_application';
    protected const DESCRIPTION = 'Update an Ashby application source, credited user, timestamp, or notification behavior.';
    protected const ENDPOINT = '/application.update';
    protected const REQUIRED = ['applicationId'];
    protected const BODY_KEYS = ['applicationId', 'sourceId', 'creditedToUserId', 'createdAt', 'sendNotifications'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'applicationId' => ['type' => 'string', 'required' => true, 'description' => 'Application UUID.'],
        'sourceId' => ['type' => 'string', 'description' => 'Source UUID.'],
        'creditedToUserId' => ['type' => 'string', 'description' => 'Credited user UUID.'],
        'sendNotifications' => ['type' => 'boolean', 'description' => 'Whether subscribed users are notified.'],
        'body' => ['type' => 'object', 'description' => 'Raw application.update body.'],
    ];
}

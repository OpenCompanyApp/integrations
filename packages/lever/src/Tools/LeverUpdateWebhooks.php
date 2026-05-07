<?php

namespace OpenCompany\Integrations\Lever\Tools;

/**
 * Update one or more API-created Lever webhooks.
 */
class LeverUpdateWebhooks extends AbstractLeverDataTool
{
    protected const TOOL_NAME = 'lever_update_webhooks';
    protected const TOOL_DESCRIPTION = 'Update one or more API-created Lever webhooks. Official Lever Data API endpoint: PUT /webhooks.';
    protected const METHOD = 'PUT';
    protected const PATH = '/webhooks';
    protected const PARAMETERS = [
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'Webhook update payload, usually containing a webhooks array.'],
        'params' => ['type' => 'object', 'required' => false, 'description' => 'Additional Lever query parameters.'],
    ];
}

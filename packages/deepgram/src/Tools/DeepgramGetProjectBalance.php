<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Get one Deepgram project balance.
 */
class DeepgramGetProjectBalance extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_get_project_balance';
    protected const DESCRIPTION = 'Get details for one Deepgram project balance.';
    protected const SERVICE_METHOD = 'getProjectBalance';
    protected const MODE = 'two_ids';
    protected const ID_KEY = 'project_id';
    protected const SECOND_ID_KEY = 'balance_id';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'balance_id' => ['type' => 'string', 'required' => true, 'description' => 'Balance ID.'],
    ];
}

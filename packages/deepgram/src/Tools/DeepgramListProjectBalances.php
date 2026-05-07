<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * List outstanding balances for a Deepgram project.
 */
class DeepgramListProjectBalances extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_list_project_balances';
    protected const DESCRIPTION = 'List outstanding billing balances for a Deepgram project.';
    protected const SERVICE_METHOD = 'listProjectBalances';
    protected const MODE = 'id';
    protected const ID_KEY = 'project_id';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
    ];
}

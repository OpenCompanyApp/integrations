<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse score by ID.
 */
class LangfuseGetScore extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_score';
    protected const DESCRIPTION = 'Retrieve a Langfuse score by ID.';
    protected const SERVICE_METHOD = 'getScore';
    protected const MODE = 'id';
    protected const ID_KEY = 'score_id';
    protected const PARAMETERS = [
        'score_id' => ['type' => 'string', 'required' => true, 'description' => 'Score ID.'],
    ];
}

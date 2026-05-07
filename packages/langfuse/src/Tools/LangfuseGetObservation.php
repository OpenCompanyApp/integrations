<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Retrieve a Langfuse observation by ID.
 */
class LangfuseGetObservation extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_get_observation';
    protected const DESCRIPTION = 'Retrieve a Langfuse observation by ID.';
    protected const SERVICE_METHOD = 'getObservation';
    protected const MODE = 'id';
    protected const ID_KEY = 'observation_id';
    protected const PARAMETERS = [
        'observation_id' => ['type' => 'string', 'required' => true, 'description' => 'Observation ID.'],
    ];
}

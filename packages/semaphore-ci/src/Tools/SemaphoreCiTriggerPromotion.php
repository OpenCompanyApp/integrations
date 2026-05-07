<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Trigger a Semaphore promotion.
 */
class SemaphoreCiTriggerPromotion extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_trigger_promotion';
    protected const DESCRIPTION = 'Trigger a Semaphore promotion. Payload must include pipeline_id and name.';
    protected const METHOD = 'triggerPromotion';
    protected const REQUIRED = ['payload'];
    protected const PARAMETERS = ['payload' => ['type' => 'object', 'required' => true, 'description' => 'Promotion payload with pipeline_id, name, optional override, and parameter values.']];
}

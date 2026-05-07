<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * List Semaphore promotions.
 */
class SemaphoreCiListPromotions extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_list_promotions';
    protected const DESCRIPTION = 'List promotions for a Semaphore pipeline.';
    protected const METHOD = 'listPromotions';
    protected const REQUIRED = ['pipeline_id'];
    protected const PARAMETERS = ['pipeline_id' => ['type' => 'string', 'required' => true, 'description' => 'Pipeline UUID.']];
}

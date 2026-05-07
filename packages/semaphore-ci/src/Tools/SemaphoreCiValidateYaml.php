<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

/**
 * Validate Semaphore pipeline YAML.
 */
class SemaphoreCiValidateYaml extends AbstractSemaphoreCiTool
{
    protected const NAME = 'semaphore_ci_validate_yaml';
    protected const DESCRIPTION = 'Validate a Semaphore pipeline YAML document.';
    protected const METHOD = 'validateYaml';
    protected const REQUIRED = ['payload'];
    protected const PARAMETERS = ['payload' => ['type' => 'object', 'required' => true, 'description' => 'YAML validation payload with yaml_definition.']];
}

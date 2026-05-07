<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Retrieve a Groq model by ID.
 */
class GroqGetModel extends AbstractGroqTool
{
    protected const NAME = 'groq_get_model';
    protected const DESCRIPTION = 'Retrieve detailed metadata for a Groq model.';
    protected const METHOD = 'getModel';
    protected const ARGUMENTS = ['model'];
    protected const REQUIRED = ['model'];
}

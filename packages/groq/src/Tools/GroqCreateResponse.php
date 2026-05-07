<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Create a response through Groq's beta Responses endpoint.
 */
class GroqCreateResponse extends AbstractGroqTool
{
    protected const NAME = 'groq_create_response';
    protected const DESCRIPTION = 'Create a response through Groq beta Responses API.';
    protected const METHOD = 'createResponse';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}

<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Extract document content with Mistral OCR.
 */
class MistralOcr extends AbstractMistralTool
{
    protected const NAME = 'mistral_ocr';
    protected const DESCRIPTION = 'Run Mistral OCR over a document URL, uploaded file reference, or base64 document input.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/ocr';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'OCR body with model and document fields as supported by Mistral.']];
}

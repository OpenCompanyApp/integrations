<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Generic Integration.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/integrations/webhook.
 */
class ShortcutCreateGenericIntegration extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_generic_integration';
    protected const DESCRIPTION = 'Create Generic Integration

Official Shortcut endpoint: POST /api/v3/integrations/webhook.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/integrations/webhook';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

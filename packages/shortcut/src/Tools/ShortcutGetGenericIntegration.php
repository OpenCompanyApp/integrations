<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Generic Integration.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/integrations/webhook/{integration-public-id}.
 */
class ShortcutGetGenericIntegration extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_generic_integration';
    protected const DESCRIPTION = 'Get Generic Integration

Official Shortcut endpoint: GET /api/v3/integrations/webhook/{integration-public-id}.';
    protected const PARAMETERS = [
        'integration_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'integration-public-id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/integrations/webhook/{integration-public-id}';
    protected const PATH_PARAMS = [
        'integration-public-id' => 'integration_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

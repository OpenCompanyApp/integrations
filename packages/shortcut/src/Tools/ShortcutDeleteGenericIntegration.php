<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Generic Integration.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/integrations/webhook/{integration-public-id}.
 */
class ShortcutDeleteGenericIntegration extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_generic_integration';
    protected const DESCRIPTION = 'Delete Generic Integration

Official Shortcut endpoint: DELETE /api/v3/integrations/webhook/{integration-public-id}.';
    protected const PARAMETERS = [
        'integration_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'integration-public-id',
        ],
    ];
    protected const METHOD = 'DELETE';
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
